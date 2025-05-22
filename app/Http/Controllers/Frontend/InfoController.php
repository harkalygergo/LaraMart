<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Info;
use App\Models\Menu;

class InfoController extends Controller
{
    public function index()
    {
        return view(env('LAYOUT').'.info.index', [
            'title' => 'Info',
            'blogs' => Info::all(),
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function show(string $slug)
    {
        $blog = Info::where('slug', $slug)->first();

        return view(env('LAYOUT').'.page', [
            'page' => $blog,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);

    }
}
