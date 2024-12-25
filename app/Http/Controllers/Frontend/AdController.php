<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdController extends Controller
{
    public function getAdsFromJson()
    {
        // get all Merchants from database which has a status of 1 and product_feed_url is not null
        $merchants = Merchant::where('status', 1)->whereNotNull('product_feed_url')->get();

        // loop through the merchants
        foreach ($merchants as $merchant) {
            // get all ads ID from database where merchant_id is the merchant id
            $merchantAds = Ad::where('merchant_id', $merchant->id)->pluck('externalId')->toArray();

            // get the JSON data from the product_feed_url
            $json = file_get_contents($merchant->product_feed_url);

            // check if json is valid json
            if (json_decode($json) === null) {
                continue;
            }

            // delete all ads from database where merchant_id is the merchant id
            //Ad::where('merchant_id', $merchant->id)->delete();

            $data = json_decode($json, true);

            // loop through the products
            foreach ($data as $product) {
                // check if externalID and merchant_id is already in the database
                $ad = Ad::where('externalId', $product['id'])->where('merchant_id', $merchant->id);

                // update
                if ($ad->exists()) {
                    $ad = $ad->first();

                    // remove ID from $merchantAds array
                    if (in_array($ad->externalId, $merchantAds)) {
                        $merchantAds = array_diff($merchantAds, [$ad->externalId]);
                    }

                    $this->databaseAction($ad, $product, null, $merchant);
                }
                // insert
                else {
                    // if not, create a new ad
                    $this->new($product, $merchant);
                }
            }

            Ad::where('merchant_id', $merchant->id)->whereIn('externalId', $merchantAds)->delete();
        }

        // redirect to homepage
        return redirect('/');
    }

    public function new($product, Merchant $merchant=null, User $user=null): ?Ad
    {
        $ad = new Ad();
        return $this->databaseAction($ad, $product, $user, $merchant);
    }

    public function databaseAction(Ad $ad, array $product=[], User $user=null, Merchant $merchant=null): ?Ad
    {
        if (empty($product)) {
            return null;
        }

        // set the title to the product subject
        $ad->title = $product['subject'];
        // set the description to the product description
        if (substr($product['description'], 0, 1) == "\n") {
            $ad->description = substr($product['description'], 1);
        } else {
            $ad->description = $product['description'];
        }
        // set the price to the product price
        $ad->price = $product['price'];
        // set categoryType1 to the product categoryType1
        $ad->categoryType1 = $product['categoryType1'];
        // set categoryType2 to the product categoryType2
        if (isset($product['categoryType2'])) {
            $ad->categoryType2 = $product['categoryType2'];
        }
        // set categoryType3 to the product categoryType3
        if (isset($product['categoryType3'])) {
            $ad->categoryType3 = $product['categoryType3'];
        }
        // set the attributes to the product attributes
        if (isset($product['attributes'])) {
            $ad->attributes = json_encode($product['attributes'], JSON_UNESCAPED_UNICODE);
        }

        if ($user) {
            // set the user_id to the user id
            $ad->user_id = $user->id;
            // set the url to the product slug
            $ad->url = Str::slug($product['subject']).'-'.now()->timestamp;
        }

        if ($merchant) {
            // set the merchant_id to the merchant id
            $ad->merchant_id = $merchant->id;

            // set the externalId to the product id
            if (isset($product['id'])) {
                $ad->externalId = $product['id'];
            }

            if (isset($product['external_link'])) {
                $ad->external_link = $product['external_link'];
            }

            // set the url to the product slug
            if (isset($product['slug'])) {
                $ad->url = $product['slug'];
            } else {
                $ad->url = Str::slug($product['subject']).'-'.now()->timestamp;
            }

            // set the images to the product images
            $ad->images = json_encode($product['images'], JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
        }
        // save the ad
        $ad->save();

        if ($user) {
            if (!empty($product['images']) && is_array($product['images'])) {
                foreach ($product['images'] as $image) {
                    $ad->addMedia($image)->toMediaCollection($ad->id, 'public');
                }
            }
        }

        return $ad;
    }

    public function showAd($slug)
    {
        $ad = Ad::where('url', $slug)->first();

        // if ad is not found, return 404
        if (!$ad) {
            abort(404);
        }

        // get 6 ads based on last_view column
        $relatedAds = Ad::where('id', '!=', $ad->id)->orderBy('last_view', 'desc')->limit(8)->get();

        // update ad last_view column
        $ad->last_view = now();
        $ad->save();

        // call the importAttributes function from the AttributeController
        (new AttributeController())->importAttributes($ad);

        return view('layouts.frontend.default.product', [
            'ad' => $ad,
            'allAttributes' => (new AttributeController())->getAttributes(),
            'relatedAds' => $relatedAds,
        ]);
    }

    public function delete($id)
    {
        // if user is not authenticated, return 404
        if (!auth()->check()) {
            abort(404);
        }

        // if user is not the owner of the ad, return 404
        if (auth()->user()->id != Ad::find($id)->user_id) {
            abort(404);
        }

        Ad::find($id)->delete();

        return redirect('/profil');
    }

    public function search()
    {
        $query = request('s');

        $results = Ad::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('attributes', 'like', "%$query%")
            ->get();

        $resultsCount = $results->count();

        return view('layouts.frontend.default.pages.list', [
            'searchQuery' => $query,
            'title' => "Keresés: $query (találat: $resultsCount darab)",
            'ads' => $results,
        ]);
    }

    public function showMerchantAds($slug)
    {
        $merchant = Merchant::where('slug', $slug)->first();

        if (!$merchant) {
            abort(404);
        }

        $ads = Ad::where('merchant_id', $merchant->id)->get();

        return view('layouts.frontend.default.pages.list', [
            'title' => $merchant->name,
            'ads' => $ads,
        ]);
    }

    // create a form for the user to add new ad with form
    public function create()
    {
        // if post request
        if (request()->isMethod('post')) {
            $ad = $this->new(request()->all(), null, auth()->user());

            return redirect('/hirdetes/'.$ad->url);
        }

        return view('layouts.frontend.default.pages.new-ad', [
            // get all categories from the database where parent_id is null
            'categoryType1' => Category::whereNull('parent_id')->get(),
        ]);
    }

    public function deleteMedia(int $adID=0, int $userID=0, int $mediaID=0)
    {
        // if ad exists with adID=$adID and user_id=$userID
        if (!Ad::where('id', $adID)->where('user_id', $userID)->exists()) {
            abort(404);
        }

        // find media where model_id is adID and id is mediaID
        $media = Media::where('model_id', $adID)->where('id', $mediaID)->first();
        $media->delete();

        return redirect()->back();
    }

    public function edit(int $id)
    {
        $ad = Ad::find($id);

        // if post request
        if (request()->isMethod('put')) {
            $this->databaseAction($ad, request()->all(), auth()->user(), null);

            return redirect('/hirdetes/'.$ad->url);
        }

        return view('layouts.frontend.default.pages.new-ad', [
            'ad' => $ad,
            // get all categories from the database where parent_id is null
            'categoryType1' => Category::whereNull('parent_id')->get(),
        ]);
    }

    // handle the form submission
    public function store()
    {
        // validate the request data
        request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ]);

        // create a new Ad object
        $ad = new Ad();
        // set the title to the request title
        $ad->title = request('title');
        // set the description to the request description
        $ad->description = request('description');
        // set the price to the request price
        $ad->price = request('price');
        // set the user_id to the authenticated user id
        $ad->user_id = auth()->id();
        // save the ad
        $ad->save();

        // upload the image
        $ad->addMedia(request('image'))->toMediaCollection('images', 'public');

        return redirect('/profil');
    }
}
