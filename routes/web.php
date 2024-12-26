<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Frontend\AdController;
use App\Http\Controllers\Frontend\BarionController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\IMEIController;
use App\Http\Controllers\Frontend\MessageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

// call HomeController@index when the user visits the root URL
Route::get('/', [HomepageController::class, 'index']);

Route::get('/search', [AdController::class, 'search']);
Route::get('/merchant/{slug}', [AdController::class, 'showMerchantAds']);

Route::get('/blog', [BlogController::class, 'list']);
Route::get('/info/{slug}', [PageController::class, 'show']);

Route::get('/importAttributes', [\App\Http\Controllers\Frontend\AttributeController::class, 'importAttributes']);

Route::match(['get', 'post'], '/ad/create', [AdController::class, 'create'])->name('createAd');
Route::get('/ad/{slug}', [AdController::class, 'showAd']);
Route::match(['get', 'put'], '/ad/edit/{id}', [AdController::class, 'edit']);
Route::delete('/ad/delete/{id}', [AdController::class, 'delete']);
Route::get('/ad/{adID}/media/{userID}/delete/{mediaID}', [AdController::class, 'deleteMedia']);

Route::get('/category/import', [CategoryController::class, 'importCategoriesFromXML']);
Route::get('/category/{slug}', [CategoryController::class, 'showCategory']);

Route::get('/ad', function () {
    return view('layouts.frontend.default.product');
})->name('product');

Route::match(['get', 'post', 'put'], '/profile', [UserController::class, 'profile'])->name('login');
Route::match(['get', 'post', 'put'], '/addProfilePoint', [UserController::class, 'addProfilePoint'])->name('addProfilePoint');

Route::match(['get', 'post'], '/register', [UserController::class, 'registerForm'])->name('register');

/* API */
Route::get('/api/cron', [AdController::class, 'getAdsFromJson']);

// message/new to handle new message
Route::post('/message/new', [MessageController::class, 'handleNew']);

// route for creaetPreparePayment
Route::match(['get', 'post'], '/barion', [BarionController::class, 'createPreparePayment']);

/* ADMIN V1 */
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin/v1')->group(function () {
        // Apply admin middleware to all admin routes
        Route::middleware(['App\Http\Middleware\AdminMiddleware'])->group(function () {            // Your admin routes go here
            Route::get('/', [BackendController::class, 'index']);
            Route::get('users/', [BackendController::class, 'showUsers'])->name('showUsers');
            Route::get('users/admins', [BackendController::class, 'showAdmins'])->name('showAdmins');
            Route::match(['get', 'post'], 'merchants/', [BackendController::class, 'showMerchants']);
            Route::match(['get', 'post', 'put'], 'user/{id}', [BackendController::class, 'showUser']);
            Route::get('merchant/show/{id}', [BackendController::class, 'showMerchant'])->name('showMerchant');
            Route::get('user/delete/{id}', [BackendController::class, 'deleteUser']);
            Route::get('merchant/delete/{id}', [BackendController::class, 'deleteMerchant']);
            Route::match(['get', 'post', 'put'], 'user/edit/{id}', [BackendController::class, 'editUser'])->name('editUser');
            Route::get('merchant/edit/{id}', [BackendController::class, 'editMerchant']);
            Route::match(['get', 'post'], 'merchant/create', [BackendController::class, 'createMerchant']);
            Route::get('merchant/delete/{id}', [BackendController::class, 'deleteMerchant']);
            Route::get('merchant/edit/{id}', [BackendController::class, 'editMerchant']);
            Route::get('users/ads/', [BackendController::class, 'showUserAds']);
            Route::get('merchants/ads/', [BackendController::class, 'showMerchantAds']);
            Route::get('attributes/', [BackendController::class, 'showAttributes']);
            Route::get('categories', [BackendController::class, 'showCategories']);
            Route::get('pages/', [\App\Http\Controllers\Backend\PageController::class, 'showPages']);
            Route::match(['get', 'post', 'put', 'delete'], 'page/add', [\App\Http\Controllers\Backend\PageController::class, 'addPage'])->name('addPage');
            Route::match(['get', 'post', 'put', 'delete'], 'page/edit/{page}', [\App\Http\Controllers\Backend\PageController::class, 'action'])->name('editPage');
            Route::get('settings/', [BackendController::class, 'showSettings']);
            Route::get('banners/', [\App\Http\Controllers\Backend\BannerController::class, 'list'])->name('banners');
            Route::match(['get', 'post', 'put', 'delete'], 'banners/new', [\App\Http\Controllers\Backend\BannerController::class, 'create'])->name('newBanner');
            Route::match(['get', 'post', 'put', 'delete'], 'banners/edit/{id}', [\App\Http\Controllers\Backend\BannerController::class, 'edit'])->name('editBanner');
            Route::delete('banners/delete/{id}', [\App\Http\Controllers\Backend\BannerController::class, 'delete'])->name('deleteBanner');
        });
    });

    // Non-admin routes go here
    /* USER */
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/add-favourite/{adId}', [UserController::class, 'addFavourite']);
    Route::get('/remove-favourite/{adId}', [UserController::class, 'removeFavourite']);
});
