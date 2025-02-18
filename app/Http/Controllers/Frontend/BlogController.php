<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Menu;

class BlogController extends Controller
{
    public function index()
    {
        return view(env('LAYOUT').'.blog.index', [
            'title' => 'Blog',
            'blogs' => Blog::all(),
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        return view(env('LAYOUT').'.page', [
            'page' => $blog,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);

    }
}
