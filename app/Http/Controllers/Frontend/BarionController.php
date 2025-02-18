<?php

namespace App\Http\Controllers\Frontend;

use Barion\Enumerations\BarionEnvironment;
use Barion\Enumerations\FundingSourceType;
use Illuminate\Http\Request;

class BarionController extends Controller
{
    private ?string $randomID;
    private ?bool $demo;
    private ?string $POSKey;
    private ?string $login;
    private BarionEnvironment $environment;
    private int $apiVersion = 2;

    public function __construct()
    {
        if (!isset($_POST['quantity'])) {
            abort(404);
        }

        $this->demo = (env('APP_ENV') == "local");
        $this->randomID = env('APP_NAME')."-".date('YmdHis').'-'.rand(1000, 9999);

        if ($this->demo) {
            $this->POSKey = env("BARION_POSKEY_DEMO");
            $this->login = env("BARION_LOGIN_DEMO");
            $this->environment = BarionEnvironment::Test;
        } else {
            $this->POSKey = env("BARION_POSKEY_PROD");
            $this->login = env("BARION_LOGIN_PROD");
            $this->environment = BarionEnvironment::Prod;
        }

        parent::__construct();
    }

    public function createItemModel(Request $request)
    {
        $item = new \Barion\Models\Common\ItemModel();
        $item->Name = env('APP_NAME') . " pontok";
        $item->Description = env('APP_NAME') . " webshopban vásárolt kredit.";
        // get request from post object
        $item->Quantity = $request->input('quantity');
        $item->Unit = "pont";
        $item->UnitPrice = 1;
        $item->ItemTotal = $request->input('quantity');

        return $item;
    }

    public function createPaymentTransactionModel(Request $request)
    {
        $trans = new \Barion\Models\Payment\PaymentTransactionModel();
        $trans->POSTransactionId = $this->randomID;
        $trans->Payee = $this->login;
        $trans->Total = $request->input('quantity');
        $trans->Comment = env('APP_NAME') . " pontok vásárlása";
        $trans->AddItem($this->createItemModel($request));

        return $trans;
    }

    public function createPreparePaymentRequestModel(Request $request)
    {
        $ppr = new \Barion\Models\Payment\PreparePaymentRequestModel();
        $ppr->GuestCheckout = true;
        $ppr->PaymentType = \Barion\Enumerations\PaymentType::Immediate;
        $ppr->FundingSources = array(FundingSourceType::All);
        $ppr->PaymentRequestId = $this->randomID;
        $ppr->PayerHint = $request->input('email');
        $ppr->Locale = \Barion\Enumerations\UILocale::EN;
        $ppr->OrderNumber = $this->randomID;
        $ppr->Currency = \Barion\Enumerations\Currency::HUF;
        // get request from url
        $ppr->RedirectUrl = env('APP_URL') . "/addProfilePoint?amount=".$request->input('quantity');
        $ppr->CallbackUrl = env('APP_URL') . "/profil";
        $ppr->AddTransaction($this->createPaymentTransactionModel($request));

        return $ppr;
    }

    private function getBC()
    {
        return new \Barion\BarionClient(
            poskey: $this->POSKey,
            version: $this->apiVersion,
            env: $this->environment,
            useBundledRootCerts: false
        );
    }

    public function createPreparePayment(Request $request)
    {
        $payment = $this->getBC()->PreparePayment($this->createPreparePaymentRequestModel($request));

        if (empty($payment->Errors)) {
            return redirect($payment->PaymentRedirectUrl);
        }

        // redirect to profile with error show | //->withErrors(['email' => 'A megadott adatok nem megfelelőek.',]);
        return redirect()->route('profile')->with('error', $payment->Errors[0]->Description);
    }

    public function getBarionPaymentResult(string $PaymentId='')
    {
        $BC = $this->getBC();
        $BC->SetVersion(4);
        $paymentDetails = $BC->PaymentState($PaymentId);

        return $paymentDetails;
    }
}
