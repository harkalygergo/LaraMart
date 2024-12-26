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

    public function create()
    {
        // handle posted data
        if (request()->isMethod('post')) {
            $data = request()->validate([
                'mediaURL' => 'required',
                'position' => 'required',
            ]);

            // Merge the optional fields
            $data = array_merge($data, request()->only(['href', 'hrefTarget']));

            Banner::create($data);

            return redirect()->route('banners');
        }


        return view('layouts.backend.banner-create');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        if (request()->isMethod('post')) {
            $data = request()->validate([
                'mediaURL' => 'required',
                'position' => 'required',
            ]);

            // Merge the optional fields
            $data = array_merge($data, request()->only(['href', 'hrefTarget']));

            $banner->update($data);

            return redirect()->route('banners');
        }

        return view('layouts.backend.banner-edit', [
            'data' => $banner,
        ]);
    }

    public function delete($id)
    {
        Banner::findOrFail($id)->delete();

        return redirect()->route('banners');
    }
}
