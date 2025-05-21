<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Email\EmailController;
use App\Models\Ad;
use App\Models\Menu;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginHandle(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Check if the user exists and the password is correct
            if (Hash::check($request->password, $user->password)) {
                // Log the user in
                Auth::login($user, true);
                // add cookie to remember the login type is user
                //setcookie('login_type', 'user', time() + (86400 * 30), "/"); // 86400 = 1 day


                //$user->save();
                return redirect()
                    ->route('login')
                    ->withHeaders([
                        'Set-Cookie' => cookie('logged_in_account_type', 'user', 60*24*30)->__toString(),
                    ]);
            }
        }
        // else check if email exists in merchants
        else {
            $merchant = Merchant::where('email', $request->email)->first();
            if ($merchant && Hash::check($request->password, $merchant->password)) {
                // Log the merchant in using the custom guard
                Auth::guard('merchant')->login($merchant, true);

                return redirect()
                    ->route('login')
                    ->withHeaders([
                        'Set-Cookie' => cookie('logged_in_account_type', 'merchant', 60*24*30)->__toString(),
                    ]);
            }
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'A megadott adatok nem megfelelőek.',
        ]);
    }

    public function passwordReset()
    {
        // Check if the request is a POST request
        if (request()->isMethod('post')) {
            // Handle the password reset logic here
            return $this->passwordResetHandle(request());
        }

        return view(env('LAYOUT').'.pages.password-reset', [
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function passwordResetHandle(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in the users table
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Generate a password reset token
            $token = Str::random(60);

            $user->password = $token;
            $user->save();

            (new EmailController())->sendEmail(
                env('MAIL_FROM_NAME'),
                env('MAIL_FROM_ADDRESS'),
                $user->name,
                $user->email,
                'Új jelszó',
                $token.'<br><br><br>'.env('APP_URL'),
            );

            // redirect to login page
            return redirect()->route('login')->with('success', 'A jelszó visszaállító linket elküldtük az email címére.');
        }

        // If the email doesn't exist, redirect back with an error message
        return redirect()->back()->withErrors([
            'email' => 'A megadott email cím nem található.',
        ]);
    }

    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to the homepage
        return redirect('/');
    }

    public function registerHandle(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'zip' => 'required|string',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->zip = $request->zip;
        $user->billing_zip = $request->zip;
        $user->password = Hash::make($request->password);
        $user->save();

        // Log the user in
        Auth::login($user, true);

        return redirect()->route('login');
    }

    public function addProfilePoint(Request $request)
    {
        $user = Auth::user();
        $user->points += $request->input('amount');
        $user->save();

        return redirect()->route('login');
    }

    public function profile()
    {
        // check if post request for login
        if (request()->isMethod('post')) {
            return $this->loginHandle(request());
        }

        // check if post request for login
        if (request()->isMethod('put')) {
            return $this->profileUpdateFormHandle(request());
        }

        if (!Auth::check() && !Auth::guard('merchant')->check()) {
            return view(env('LAYOUT').'.pages.login', [
                'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            ]);
        }

        $user = Auth::user() ?: Auth::guard('merchant')->user();

        return view(env('LAYOUT').'.pages.profile', [
            'user' => $user,
            'favoriteAds' => $user->favourites,
            'ads' => Ad::where('user_id', auth()->id())->get(),
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            'groupedMessages' => (new MessageController())->getMessages(),
        ]);
    }

    public function registerForm()
    {
        // if post is sent, register the user
        if (request()->isMethod('post')) {
            return $this->registerHandle(request());
        }

        return view(env('LAYOUT').'.pages.register', [
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function profileUpdateFormHandle(Request $request)
    {
        //dd($request->all());
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'zip' => 'required|int',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->zip = $request->zip;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->billing_name = (empty($user->billing_name) && empty($request->billingName)) ? $request->name : $request->billingName;
        $user->billing_zip = (empty($user->billing_zip) && empty($request->billingZip)) ? $request->zip : $request->billingZip;
        $user->billing_city = (empty($user->billing_city) && empty($request->billingCity)) ? $request->city : $request->billingCity;
        $user->billing_address = (empty($user->billing_address) && empty($request->billingAddress)) ? $request->address : $request->billingAddress;
        $user->home_delivery = $request->home_delivery;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('login')->with('success', 'Profil sikeresen frissítve.');
    }

    public function addFavourite($adId)
    {
        $user = Auth::user();
        $favourites = $user->favourites;

        // if the user has no favourites yet, create an empty array
        if (empty($favourites)) {
            $favourites = [];
        } else {
            $favourites = json_decode($favourites, true);
        }

        // add the ad ID to the favourites array
        $favourites[] = $adId;

        // update the user's favourites
        $user->favourites = $favourites;
        $user->save();

        return redirect()->back();
    }

    // function to remove ad from favourites
    public function removeFavourite($adId)
    {
        $user = Auth::user();
        $favourites = $user->favourites;

        // if the user has no favourites yet, create an empty array
        if (empty($favourites)) {
            $favourites = [];
        } else {
            $favourites = json_decode($favourites, true);
        }

        // remove the ad ID from the favourites array
        $favourites = array_diff($favourites, [$adId]);

        // update the user's favourites
        $user->favourites = $favourites;
        $user->save();

        return redirect()->back();
    }
}
