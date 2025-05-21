<?php

namespace App\Http\Controllers\Backend\ProductType;

use App\Http\Controllers\Frontend\Controller;
use App\Models\Ad;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\ProductType;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProductTypeController extends Controller
{
    // create new product type
    public function newProductType()
    {
        $availableAttributes = Attribute::all();
        $availableAttributes = $availableAttributes->toArray();

        if (request()->isMethod('post')) {
            request()->validate([
                'name' => 'required',
                'slug' => 'required',
                'description' => 'required',
            ]);

            $productType = new ProductType();
            $productType->name = request('name');
            $productType->slug = request('slug');
            $productType->description = request('description');
            $productType->save();

            $availableAttributes = Attribute::all();
            $availableAttributes = $availableAttributes->toArray();

            return view('layouts.backend.productTypes.edit', [
                'productType' => ProductType::where('slug', request('slug'))->first(),
                'availableAttributes' => $availableAttributes,
            ])->with('success', 'Product type created successfully');
        }

        return view('layouts.backend.productTypes.new', [
            'availableAttributes' => $availableAttributes,
        ])->with('success', 'Product type created successfully');
    }


    public function editProductType($id)
    {
        $productType = ProductType::find($id);
        $availableAttributes = Attribute::all();
        $availableAttributes = $availableAttributes->toArray();

        if (request()->isMethod('put')) {
            $attributes = request('attributes');

            if (!is_null($attributes)){
                foreach ($attributes as $attribute) {
                    $productType->attributes()->attach($attribute);
                }
            }

            request()->validate([
                'name' => 'required',
                'slug' => 'required',
                'description' => 'required',
            ]);

            $productType->name = request('name');
            $productType->slug = request('slug');
            $productType->description = request('description');
            $productType->save();

            //return redirect()->route('showProductTypes');
        }

        return view('layouts.backend.productTypes.edit', [
            'productType' => ProductType::find($id),
            'availableAttributes' => $availableAttributes,
        ])->with('success', 'Product type updated successfully');
    }
}
