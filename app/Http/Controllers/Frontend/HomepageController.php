<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use App\Models\Banner;
use App\Models\Menu;
use Illuminate\Routing\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        return view('layouts.frontend.default.homepage', [
            // get all ads from database order by created_at desc
            'ads' => Ad::orderBy('created_at', 'desc')->get(),
            // get banners from database order by position
            'banners' => Banner::orderBy('position')->get(),
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }
}
