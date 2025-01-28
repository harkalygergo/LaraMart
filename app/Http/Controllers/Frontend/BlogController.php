<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Menu;

class BlogController extends Controller
{
    public function list()
    {
        return view('layouts.frontend.default.pages.list', [
            'title' => 'Blog',
            'ads' => Blog::all(),
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }
}
