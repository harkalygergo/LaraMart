<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function __construct()
    {
        // if user is logged in, update last_activity to current timestamp
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_activity = now();
            $user->save();
        }
        if (Auth::guard('merchant')->check()) {
            $user = Auth::guard('merchant')->user();
            $user->last_activity = now();
            $user->save();
        }
    }
}
