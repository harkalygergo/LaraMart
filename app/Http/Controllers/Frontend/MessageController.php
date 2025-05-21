<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Email\EmailController;
use App\Models\Ad;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function handleNew()
    {
        $loggedInUser = auth()->user();
        $adId = request('ad');
        $ad = Ad::find($adId);

        if (request('to')) {
            $recipientId = request('to');
        } else {
            $recipientId = is_null($ad->user_id) ? $ad->merchant_id : $ad->user_id;
        }

        $message = new Message();
        $message->from = $loggedInUser->id;
        $message->to = $recipientId;
        $message->ad_id = $adId;
        $message->message = request('message');
        $message->save();

        // send email to recipient
        $recipient = User::find($recipientId);
        (new EmailController())->sendEmail(
            env('MAIL_FROM_NAME'),
            env('MAIL_FROM_ADDRESS'),
            $recipient->name,
            $recipient->email,
            'Új üzenet érkezett',
            $ad->title.' hirdetéshez érkezett üzenet: <br><br><br>'.
                $loggedInUser->name.' üzenete: <br><br><br>'.
                request('message').'<br><br><br>'.env('APP_URL')
            ,
        );

        return redirect()->back()->with('success', 'Üzenet elküldve.');
    }

    public function getMessages()
    {
        $userId = Auth::id();

        $groupedMessages = Message::where('from', $userId)
            ->orWhere('to', $userId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return $item->ad_id . '-' . min($item->from, $item->to) . '-' . max($item->from, $item->to);
            });

        return $groupedMessages;
    }
}
