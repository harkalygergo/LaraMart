<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Banner;

class SettingsController extends Controller
{
    public function list()
    {
        return view('layouts.backend.settings', [
            'data' => Banner::all(),
        ]);

    }
}
