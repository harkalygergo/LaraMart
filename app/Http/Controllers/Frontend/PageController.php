<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Page::create($request->all());

        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            abort(404, 'Page not found');
        }

        // if $page title contains "API" string, return 404
        if (strpos($page->title, 'API') !== false) {
            return view(env('LAYOUT').'.page-api', [
                'page' => $page,
                'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            ]);
        }

        return view(env('LAYOUT').'.page', [
            'page' => $page,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $page->update($request->all());

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully');
    }
}
