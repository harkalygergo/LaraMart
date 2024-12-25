<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();

        return view('attributes.index', compact('attributes'));
    }

    // create a function to get all ads with the same attribute
    public function importAttributes($ad)
    {
        $attributes = json_decode($ad->attributes, true);
        if (is_array($attributes)) {
            foreach ($attributes as $attributeKey => $attributeValue) {

                // check if attribute exist in the database with name $attribute['name']
                $attribute = Attribute::where('slug', $attributeKey)->first();
                // if attributeKey not exist in attributes table, create a new attribute
                if (!$attribute) {
                    $attribute = new Attribute();
                    $attribute->slug = $attributeKey;
                    $attribute->title = $attributeKey;
                    $attribute->save();
                }
            }
        }
    }

    // get all attributes as array, and return it, but the array key would be "slug" instead of "id"
    public function getAttributes()
    {
        $attributes = Attribute::all();
        $return = [];

        foreach ($attributes as $attribute) {
            $return[$attribute['slug']] = $attribute;
        }

        return $return;
    }

    public function create()
    {
        return view('attributes.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        Attribute::create($data);

        return redirect()->route('attributes.index');
    }

    public function edit(Attribute $attribute)
    {
        return view('attributes.edit', compact('attribute'));
    }

    public function update(Attribute $attribute)
    {
        $data = request()->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $attribute->update($data);

        return redirect()->route('attributes.index');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('attributes.index');
    }
}
