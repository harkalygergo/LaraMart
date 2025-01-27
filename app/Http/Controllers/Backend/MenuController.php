<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;

class MenuController extends Controller
{
    public function list()
    {
        return view('layouts.backend.menu.index', [
            'data' => Menu::all(),
        ]);
    }

    public function create()
    {
        // handle posted data
        if (request()->isMethod('put')) {
            $data = request()->validate([
                'title' => 'required',
                'link' => 'required',
                'position' => 'required|integer',
            ]);

            // Merge the optional fields
            $data = array_merge($data, request()->only(['image_url', 'position']));
            $data['is_active'] = request()->has('is_active') ? (bool) request()->input('is_active') : false;

            Menu::create($data);

            return redirect()->route('admin.menu.index');
        }


        return view('layouts.backend.menu.add');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        if (request()->isMethod('post')) {
            $data = request()->validate([
                'title' => 'required',
                'link' => 'required',
                'position' => 'required|integer',
            ]);

            // Merge the optional fields
            $data = array_merge($data, request()->only(['image_url', 'position']));
            $data['is_active'] = request()->has('is_active') ? (bool) request()->input('is_active') : false;

            $menu->update($data);

            return redirect()->route('admin.menu.index');
        }

        return view('layouts.backend.menu.edit', [
            'data' => $menu,
        ]);
    }

    public function delete($id)
    {
        Menu::findOrFail($id)->delete();

        return redirect()->route('banners');
    }
}
