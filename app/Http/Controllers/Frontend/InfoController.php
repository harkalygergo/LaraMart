<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
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

    public function index2()
    {
        return view('layouts.backend.info.index', [
            'data' => Info::all(),
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

    public function create()
    {
        // if posted, handle the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $info = new Info();
            $info->title = $_POST['title'];
            $info->slug = $_POST['slug'];
            $info->content = $_POST['content'];
            $info->save();

            return redirect()->route('indexInfo')
                ->with('success', 'Info created successfully.');
        }

        return view('layouts.backend.info.add', [
            'title' => 'Create Info',
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    // edit
    public function edit(int $info)
    {
        $entity = Info::find($info);

        //dd($_SERVER['REQUEST_METHOD']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entity->title = $_POST['title'];
            $entity->slug = $_POST['slug'];
            $entity->content = $_POST['content'];
            $entity->save();

            return redirect()->route('indexInfo')
                ->with('success', 'Info updated successfully.');
        }

            return view('layouts.backend.info.edit', [
            'title' => 'Edit Info',
            'info' => $entity,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }
}
