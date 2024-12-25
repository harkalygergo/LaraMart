<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;

class BlogController extends Controller
{
    public function list()
    {
        return view('layouts.frontend.default.pages.list', [
            'title' => 'Blog',
            'ads' => Blog::all(),
        ]);
    }
}
