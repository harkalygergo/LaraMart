<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Frontend\Controller;
use App\Models\Ad;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{
    public function index()
    {
        return view('layouts.backend.base', [
            'users' => User::all(),
            'merchants' => Merchant::all(),
        ]);
    }

    public function showUsers()
    {
        return view('layouts.backend.users', [
            'data' => User::all(),
        ]);
    }

    public function showMerchants()
    {
        return view('layouts.backend.merchants', [
            'data' => Merchant::all(),
        ]);
    }

    public function showUser($id)
    {
        return view('layouts.backend.user', [
            'user' => User::find($id),
        ]);
    }

    public function showMerchant($id)
    {
        return view('layouts.backend.merchant', [
            'merchant' => Merchant::find($id),
        ]);
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->route('showUsers');
    }

    public function deleteMerchant($id)
    {
        Merchant::find($id)->delete();
        return redirect()->route('showMerchants');
    }

    public function editUser($id)
    {
        if (request()->isMethod('put')) {
            $user = User::find($id);
            $user->name = request('name');
            $user->phone = request('phone');
            $user->email = request('email');
            $user->zip = request('zip');
            $user->city = request('city');
            $user->address = request('address');
            $user->billing_name = request('billing_name');
            $user->billing_zip = request('billing_zip');
            $user->billing_address = request('billing_address');
            $user->billing_city = request('billing_city');
            $user->is_admin = request('is_admin') ? 1 : 0;
            $user->save();

            return redirect()->route('showUsers');
        }

        // if it is a delete request, delete the user
        if (request()->isMethod('delete')) {
            // delete all ads where user_id is the id
            Ad::where('user_id', $id)->delete();
            User::find($id)->delete();

            return redirect()->route('showUsers');
        }

        return view('layouts.backend.editUser', [
            'user' => User::find($id),
        ]);
    }

    public function editMerchant($id)
    {
        // handle the post request
        if (request()->isMethod('put')) {
            $merchant = Merchant::find($id);
            $merchant->name = request('name');
            $merchant->product_feed_url = request('product_feed_url');
            $merchant->status = request('status');
            $merchant->slug = request('slug');
            $merchant->image = request('image');
            $merchant->vat = request('vat');
            $merchant->phone = request('phone');
            $merchant->email = request('email');
            $merchant->zip = request('zip');
            $merchant->city = request('city');
            $merchant->address = request('address');
            $merchant->website = request('website');
            $merchant->description = request('description');

            $merchant->save();

            return redirect()->route('showMerchants');
        }

        // if it is a delete request, delete the merchant
        if (request()->isMethod('delete')) {
            // delete all ads where merchant_id is the id
            Ad::where('merchant_id', $id)->delete();
            Merchant::find($id)->delete();

            return redirect()->route('showMerchants');
        }

        return view('layouts.backend.editMerchant', [
            'merchant' => Merchant::find($id),
        ]);
    }

    public function updateUser($id)
    {
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->zip = request('zip');
        $user->billing_zip = request('billing_zip');
        $user->save();
        return redirect()->route('showUsers');
    }

    public function updateMerchant($id)
    {
        $merchant = Merchant::find($id);
        $merchant->name = request('name');
        $merchant->product_feed_url = request('product_feed_url');
        $merchant->status = request('status');
        $merchant->save();
        return redirect()->route('showMerchants');
    }

    public function createUser()
    {
        return view('layouts.backend.createUser');
    }

    public function createMerchant()
    {
        // if it is a post request, create the merchant
        if (request()->isMethod('post')) {
            $merchant = new Merchant();
            $merchant->name = request('name');
            $merchant->slug = request('slug');
            $merchant->image = request('image');
            $merchant->vat = request('vat');
            $merchant->phone = request('phone');
            $merchant->email = request('email');
            $merchant->zip = request('zip');
            $merchant->city = request('city');
            $merchant->address = request('address');
            $merchant->website = request('website');
            $merchant->product_feed_url = request('product_feed_url');
            $merchant->password = Hash::make(request('password'));
            $merchant->status = request('status');

            $merchant->save();

            return view('layouts.backend.merchants', [
                'data' => Merchant::all(),
            ]);
        }

        return view('layouts.backend.createMerchant');
    }

    // show ads where user_id is not null, not empty
    public function showUserAds()
    {
        return view('layouts.backend.userAds', [
            'data' => Ad::whereNotNull('user_id')->where('user_id', '!=', '')->get(),
        ]);
    }

    public function showMerchantAds()
    {
        return view('layouts.backend.merchantAds', [
            'data' => Ad::whereNotNull('merchant_id')->where('merchant_id', '!=', '')->get(),
        ]);
    }

    public function showAttributes()
    {
        return view('layouts.backend.attributes', [
            'data' => Attribute::all(),
        ]);
    }

    public function showCategories()
    {
        return view('layouts.backend.categories', [
            'data' => Category::all(),
        ]);
    }

    public function showSettings()
    {
        // check if the request is a post request
        if (request()->isMethod('post')) {
            // get all settings
            $settings = Settings::all();

            // loop through the settings
            foreach ($settings as $setting) {
                // get the setting name
                $key = $setting->key;

                // get the setting value
                $value = request($key);

                // update the setting value
                $setting->value = $value;

                // save the setting
                $setting->save();
            }

            return redirect()->route('admin_v1_settings');
        }

        $settings =Settings::all();

        return view('layouts.backend.settings', [
            'settings' => $settings
        ]);
    }

    public function showAdmins()
    {
        return view('layouts.backend.users', [
            'data' => User::where('is_admin', 1)->get(),
        ]);
    }
}
