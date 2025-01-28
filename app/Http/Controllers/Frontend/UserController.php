<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use App\Models\Menu;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                //$user->save();

                // Redirect to the intended page or home
                return redirect()->intended('/profil');
            }
        }
        // else check if email exists in merchants
        else {
            $merchant = Merchant::where('email', $request->email)->first();
            if ($merchant && Hash::check($request->password, $merchant->password)) {
                // Log the merchant in using the custom guard
                Auth::guard('merchant')->login($merchant, true);
                return redirect()->intended('/profil');
            }
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'A megadott adatok nem megfelelőek.',
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

        // Redirect to the home page
        return redirect('/profil');
    }

    public function addProfilePoint(Request $request)
    {
        $user = Auth::user();
        $user->points += $request->input('amount');
        $user->save();

        return redirect('/profil');
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
            return view('layouts.frontend.default.pages.login', [
                'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            ]);
        }

        $user = Auth::user() ?: Auth::guard('merchant')->user();

        return view('layouts.frontend.default.pages.profile', [
            'user' => $user,
            'favoriteAds' => $user->favourites,
            'ads' => Ad::where('user_id', auth()->id())->get(),
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function registerForm()
    {
        // if post is sent, register the user
        if (request()->isMethod('post')) {
            return $this->registerHandle(request());
        }

        return view('layouts.frontend.default.pages.register', [
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

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/profile')->with('success', 'Profile updated successfully.');
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
