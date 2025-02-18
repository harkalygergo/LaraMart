<?php

namespace App\Http\Controllers\Backend;

use App\Models\Settings;

class SettingsController extends Controller
{
    public function getSettings()
    {
        return Settings::all()->pluck('value', 'key')->toArray();
    }
}
