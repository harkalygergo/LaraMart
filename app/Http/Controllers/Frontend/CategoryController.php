<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function showCategory($slug)
    {
        // get category by slug
        $category = Category::where('slug', $slug)->first();

        // if category is not found, return 404
        if (!$category) {
            abort(404);
        }

        // get subcategories of the category where parent_id is $category->id order by title, desc
        $subcategories = Category::where('parent_id', $category->id)->orderBy('position', 'desc')->get();

        /*
        foreach($subcategories as $subcategory) {
            $ads = Ad::where('categoryType2', $subcategory->name)->get();
            if (!$ads->isEmpty()) {
                $subcategory->ads = $ads;
            }
            echo $subcategory->name.'<br>';
        }
        */

        //$ads = Ad::where('categoryType1', $slug)->get();

        // get ads of the category where categoryType1 is $slug or categoryType2 is $slug or categoryType3 is $slug
        $ads = Ad::where('categoryType1', $category->name)
            ->orWhere('categoryType2', $category->name)
            ->orWhere('categoryType3', $category->name)
            ->get();
        /*
        $title = $slug;
        // if ads is empty, return 404
        if (!$ads->isEmpty()) {
            $title = $ads->first()->categoryType1;
        }
        */
        $title = $category->title;

        return view('layouts.frontend.default.pages.list', [
            'category' => $category,
            'subnav' => $subcategories,
            'ads' => $ads,
            'title' => $title,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function importCategoriesFromXML()
    {
        $xml = simplexml_load_file('/categories.xml');

        foreach ($xml as $xmlCategory) {
            // check if category exist in the database with name $xmlCategory->type_1
            $category = Category::where('name', $xmlCategory->type_1)->first();
            if ($category) {
                $category_id = $category->id;
            } else {
                if ($xmlCategory->type_1!='') {
                    // create a new category and save it to the database
                    $category = new Category();
                    $category->title = $xmlCategory->name;
                    $category->name = $xmlCategory->type_1;
                    $category->slug = Str::slug($xmlCategory->type_1);
                    $category->save();
                    $category_id = $category->id;
                }
            }

            $category = Category::where('name', $xmlCategory->type_2)->first();
            if ($category) {
                $category_id = $category->id;
            } else {
                if ($xmlCategory->type_2!='') {
                    // create a new category and save it to the database with type_2, parent_id is $category_id
                    $category = new Category();
                    $category->title = $xmlCategory->name;
                    $category->name = $xmlCategory->type_2;
                    $category->slug = Str::slug($xmlCategory->type_1.'-'.$xmlCategory->type_2);
                    $category->parent_id = $category_id;
                    $category->save();
                    $category_id = $category->id;
                }
            }

            if ($xmlCategory->type_2!='') {
                $category = Category::where('name', $xmlCategory->type_2)->where('name', $xmlCategory->type_3)->first();
            } else {
                $category = Category::where('name', $xmlCategory->type_3)->first();
            }

            if ($category) {
                $category_id = $category->id;
            } else {
                if ($xmlCategory->type_3!='') {
                    // create a new category and save it to the database with type_3, parent_id is $category_id
                    $category = new Category();
                    $category->title = $xmlCategory->name;
                    $category->name = $xmlCategory->type_3;
                    $category->slug = Str::slug($xmlCategory->type_1.'-'.$xmlCategory->type_2.'-'.$xmlCategory->type_3);
                    $category->parent_id = $category_id;
                    $category->save();
                }
            }
        }
    }
}
