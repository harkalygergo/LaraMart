<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Menu;
use App\Models\ProductType;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // create edit Category
    public function createCategory()
    {
        $categories = Category::where('parent_id', null)->where('status', true)->orderBy('name', 'asc')->get();
        return view(env('LAYOUT').'.pages.create-category', [
            'categories' => $categories,
            'title' => 'Kategória létrehozás',
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }

        // handle post request
        if (request()->isMethod('put')) {
            $category->name = request('name');
            $category->slug = request('slug')!=='' ? request('slug') : Str::slug(request('name'));
            $category->description = request('description');
            $category->parent_id = request('parent_id');
            $category->product_type_id = request('product_type_id');
            //$category->status = request('status') ? true : false;
            $category->save();
        }

        // get all product types;
        $productTypes = (ProductType::orderBy('name', 'asc')->get())->toArray();
        $categories = Category::where('status', true)->orderBy('name', 'asc')->get();
        // return view with category
        return view('layouts.backend.category.edit', [
            'categories' => $categories,
            'category' => $category,
            'availableProductTypes' => $productTypes,
            'title' => 'Kategória szerkesztés',
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);



        $categories = Category::where('parent_id', null)->where('status', true)->orderBy('name', 'asc')->get();
        return view(env('LAYOUT').'.pages.create-category', [
            'categories' => $categories,
            'category' => $category,
            'title' => 'Kategória szerkesztés',
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }


    public static function getCategoriesAsSelectOptions()
    {
        $options = [];

        $categories = Category::where('parent_id', null)->where('status', true)->orderBy('name', 'asc')->get();
        foreach ($categories as $category) {
            $options[$category->id] = $category->title;

            // get subcategories of the category where parent_id is $category->id order by title, desc
            $subcategories = Category::where('parent_id', $category->id)->where('status', true)->orderBy('position', 'desc')->get();
            foreach ($subcategories as $subcategory) {
                $options[$subcategory->id] = $category->title.' » '.$subcategory->title;

                // get subcategories of the category where parent_id is $subcategory->id order by title, desc
                $subSubCategories = Category::where('parent_id', $subcategory->id)->where('status', true)->orderBy('position', 'desc')->get();
                foreach ($subSubCategories as $subSubCategory) {
                    $options[$subSubCategory->id] = $category->title.' » '.$subcategory->title.' » '.$subSubCategory->title;

                    // get subcategories of the category where parent_id is $subSubCategory->id order by title, desc
                    $subSubSubCategories = Category::where('parent_id', $subSubCategory->id)->where('status', true)->orderBy('position', 'desc')->get();
                    foreach ($subSubSubCategories as $subSubSubCategory) {
                        $options[$subSubSubCategory->id] = $category->title.' » '.$subcategory->title.' » '.$subSubCategory->title.' » '.$subSubSubCategory->title;
                    }
                }
            }
        }

        return $options;
    }

    public function showCategory($slug)
    {
        // get category by slug
        $category = Category::where('slug', $slug)->first();

        // if category is not found, return 404
        if (!$category) {
            abort(404);
        }

        // get subcategories of the category where parent_id is $category->id order by title, desc
        $subcategories = Category::where('parent_id', $category->id)->where('status', true)->orderBy('position', 'desc')->get();
        $subcategories_ids = $subcategories->pluck('id')->toArray();
        $subSubCategories = Category::whereIn('parent_id', $subcategories_ids)->get()->pluck('id')->toArray();

        $ads = Ad::where('category_id', $category->id)
            ->orWhereIn('category_id', $subcategories_ids)
            ->orWhereIn('category_id', $subSubCategories)

            // or where attributes contains any of the attributes in the query string
            ->when(request()->query(), function ($query) {
                $query->where(function ($query) {
                    foreach (request()->query() as $key => $values) {
                        foreach ($values as $value) {
                            $query->orWhere('attributes', 'like', '%"'.$key.'":"'.$value.'"%');
                        }
                    }
                });
            })

            ->get();

        $attributes = [];
        foreach ($ads as $ad) {
            $adAttributes = json_decode($ad->attributes, true);

            foreach ($adAttributes as $adAttributeSlug => $adAttributeValue) {

                if (!array_key_exists($adAttributeSlug, $attributes)) {
                    $attributes[$adAttributeSlug] = [];
                }

                if (!in_array($adAttributeValue, $attributes[$adAttributeSlug]) && $adAttributeValue != '') {
                    $attributes[$adAttributeSlug][] = $adAttributeValue;
                }
            }

        }

        foreach ($attributes as $attributeKey => $attributeValue) {
            if (empty($attributes[$attributeKey])) {
                unset($attributes[$attributeKey]);
            }
        }



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
        /*
        $ads = Ad::where('categoryType1', $category->name)
            ->orWhere('categoryType2', $category->name)
            ->orWhere('categoryType3', $category->name)
            ->get();
        */
        /*
        $title = $slug;
        // if ads is empty, return 404
        if (!$ads->isEmpty()) {
            $title = $ads->first()->categoryType1;
        }
        */
        $title = $category->title;

        $availableAttributes = [];
        $allAttributes = \App\Models\Attribute::all();
        foreach ($allAttributes as $attribute) {
            $availableAttributes[$attribute['slug']] = $attribute['icon'];
        }

        $availableFilterAttributes = [];
        foreach ($allAttributes as $attribute) {
            $availableFilterAttributes[$attribute['slug']] = $attribute['icon'];
        }

        return view(env('LAYOUT').'.pages.list', [
            'attributes' => $attributes,
            'availableAttributes' => $availableAttributes,
            'availableFilterAttributes' => $availableFilterAttributes,
            'category' => $category,
            'subnav' => $subcategories,
            'ads' => $ads,
            'title' => $title,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function importCategoriesFromXML()
    {
        $csvFile = base_path().'/new-categories.csv';
        //$csv = array_map('str_getcsv', file($csvFile));

        $csv = str_getcsv(file_get_contents($csvFile), "\n");

        $mainCategory = $subCategory = $subSubCategory = $subSubSubSubCategory = 0;

        $category_id = 0;
        // loop through the csv array
        foreach ($csv as $row) {

            $row = explode(';', $row);

            // if it is the first row, skip it
            if ($row[0] == 'Főkategória') {
                continue;
            }

            //dd($row);

            // főkategória
            if ($row[0] != '' && $row[1] == '' && $row[2] == '' && $row[3] == '') {
                $category = new Category();
                $category->title = $row[0];
                $category->name = $row[0];
                $category->slug = Str::slug($row[0]);
                $category->api_id = $row[4];
                $category->setCreatedAt(now());
                $category->save();
                $mainCategory = $category->id;
                $category_id = $category->id;
            }

            // alkategória
            if ($row[0] != '' && $row[1] != '' && $row[2] == '' && $row[3] == '') {
                $category = new Category();
                $category->title = $row[1];
                $category->name = $row[1];
                $category->slug = Str::slug($row[0].'_'.$row[1]);
                $category->parent_id = $mainCategory;
                $category->api_id = $row[4];
                $category->save();
                $subCategory = $category->id;
                $category_id = $category->id;
            }

            // al-alkategória
            if ($row[0] != '' && $row[1] != '' && $row[2] != '' && $row[3] == '') {
                $category = new Category();
                $category->title = $row[2];
                $category->name = $row[2];
                $category->slug = Str::slug($row[0].'_'.$row[1].'_'.$row[2]);
                $category->parent_id = $subCategory;
                $category->api_id = $row[4];
                $category->save();
                $subSubCategory = $category->id;
                $category_id = $category->id;
            }

            // al-al-alkategória
            if ($row[0] != '' && $row[1] != '' && $row[2] != '' && $row[3] != '') {
                $category = new Category();
                $category->title = $row[3];
                $category->name = $row[3];
                $category->slug = Str::slug($row[0].'_'.$row[1].'_'.$row[2].'_'.$row[3]);
                $category->parent_id = $subSubCategory;
                $category->api_id = $row[4];
                $category->save();
                $subSubSubCategory = $category->id;
                $category_id = $category->id;
            }

                /*
                // check if category exist in the database with name $row[0]
                $category = Category::where('name', $row[0])->first();
                if ($category) {
                    $category_id = $category->id;
                } else {
                    // create a new category and save it to the database
                    $category = new Category();
                    $category->title = $row[0];
                    $category->name = $row[0];
                    $category->slug = Str::slug($row[0]);
                    $category->save();
                    $category_id = $category->id;
                }
                */
        }


        dd($csv);


        $csv = array_map('str_getcsv', file('https://pophone.eu/rrs/almapro-categories.csv'));

        $xml = simplexml_load_file('https://pophone.eu/rrs/almapro-categories.xml');

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
