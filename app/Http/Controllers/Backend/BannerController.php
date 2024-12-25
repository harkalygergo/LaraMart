<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function list()
    {
        return view('layouts.backend.banners', [
            'data' => Banner::all(),
        ]);

    }
}
