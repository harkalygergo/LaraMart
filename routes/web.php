<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ProductType\ProductTypeController;
use App\Http\Controllers\Frontend\AdController;
use App\Http\Controllers\Frontend\BarionController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\IMEIController;
use App\Http\Controllers\Frontend\InfoController;
use App\Http\Controllers\Frontend\MessageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

// call HomeController@index when the user visits the root URL
Route::get('/', [HomepageController::class, 'index']);

Route::get('/kereses', [AdController::class, 'search']);
Route::get('/kereskedo/{slug}', [AdController::class, 'showMerchantAds']);

// frontend blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// frontend info
Route::get('/info', [InfoController::class, 'index'])->name('info.index');
Route::get('/info/{slug}', [InfoController::class, 'show'])->name('info.show');

Route::get('/importAttributes', [\App\Http\Controllers\Frontend\AttributeController::class, 'importAttributes']);

Route::match(['get', 'post', 'put'], '/hirdetes/feladas', [AdController::class, 'create'])->name('createAd');
Route::get('/hirdetes/{slug}', [AdController::class, 'showAd']);
Route::match(['get', 'put'], '/hirdetes/edit/{id}', [AdController::class, 'edit']);
Route::delete('/hirdetes/delete/{id}', [AdController::class, 'delete']);
Route::get('/hirdetes/{adID}/media/{userID}/delete/{mediaID}', [AdController::class, 'deleteMedia']);

Route::post('/ad/image/reorder', [AdController::class, 'reorderMedia'])->name('ad.image.reorder');



Route::get('/kategoria/import', [CategoryController::class, 'importCategoriesFromXML']);
Route::get('/kategoria/{slug}', [CategoryController::class, 'showCategory']);

Route::match(['get', 'post', 'put'], '/profil', [UserController::class, 'profile'])->name('login');
Route::match(['get', 'post', 'put'], '/addProfilePoint', [UserController::class, 'addProfilePoint'])->name('addProfilePoint');

Route::match(['get', 'post'], '/regisztracio', [UserController::class, 'registerForm'])->name('register');
Route::match(['get', 'post'], '/password-reset', [UserController::class, 'passwordReset'])->name('passwordReset');

Route::get('/telefon-adat-lekerdezes', [IMEIController::class, 'index'])->name('telefon-adat-lekerdezes');

/* API */
Route::get('/api/cron', [AdController::class, 'getAdsFromJson'])->name('hourlyCron');

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
            Route::match(['get', 'post'], 'merchants/', [BackendController::class, 'showMerchants'])->name('showMerchants');
            Route::match(['get', 'post', 'put'], 'user/{id}', [BackendController::class, 'showUser']);
            Route::get('merchant/show/{id}', [BackendController::class, 'showMerchant'])->name('showMerchant');
            Route::get('user/delete/{id}', [BackendController::class, 'deleteUser']);
            Route::get('merchant/delete/{id}', [BackendController::class, 'deleteMerchant']);
            Route::match(['get', 'post', 'put', 'delete'], 'user/edit/{id}', [BackendController::class, 'editUser'])->name('editUser');
            Route::match(['get', 'post', 'put', 'delete'], 'merchant/edit/{id}', [BackendController::class, 'editMerchant'])->name("editMerchant");
            Route::match(['get', 'post'], 'merchant/create', [BackendController::class, 'createMerchant']);
            Route::get('merchant/delete/{id}', [BackendController::class, 'deleteMerchant']);
            Route::get('users/ads/', [BackendController::class, 'showUserAds']);
            Route::get('merchants/ads/', [BackendController::class, 'showMerchantAds']);
            Route::get('attributes/', [BackendController::class, 'showAttributes']);
            Route::get('product-types/', [BackendController::class, 'showProductTypes']);

            // category
            Route::get('categories', [BackendController::class, 'showCategories']);
            Route::match(['get', 'post', 'put', 'delete'], 'category/edit/{id}', [CategoryController::class, 'edit'])->name("editCategory");


            Route::get('pages/', [\App\Http\Controllers\Backend\PageController::class, 'showPages']);
            Route::match(['get', 'post', 'put', 'delete'], 'page/add', [\App\Http\Controllers\Backend\PageController::class, 'addPage'])->name('addPage');
            Route::match(['get', 'post', 'put', 'delete'], 'page/edit/{page}', [\App\Http\Controllers\Backend\PageController::class, 'action'])->name('editPage');
            Route::match(['get', 'post', 'put', 'delete'], 'product-type/add', [ProductTypeController::class, 'newProductType'])->name('newProductType');
            Route::match(['get', 'post', 'put', 'delete'], 'product-type/edit/{id}', [ProductTypeController::class, 'editProductType'])->name('editProductType');
            Route::match(['get', 'post', 'put', 'delete'], 'settings/', [BackendController::class, 'showSettings'])->name('admin_v1_settings');
            Route::get('banners/', [\App\Http\Controllers\Backend\BannerController::class, 'list'])->name('banners');
            Route::match(['get', 'post', 'put', 'delete'], 'banners/new', [\App\Http\Controllers\Backend\BannerController::class, 'create'])->name('newBanner');
            Route::match(['get', 'post', 'put', 'delete'], 'banners/edit/{id}', [\App\Http\Controllers\Backend\BannerController::class, 'edit'])->name('editBanner');
            Route::delete('banners/delete/{id}', [\App\Http\Controllers\Backend\BannerController::class, 'delete'])->name('deleteBanner');

            // admin blog
            Route::get('blog/', [\App\Http\Controllers\Backend\BlogController::class, 'index'])->name('admin.blog.index');
            Route::match(['get', 'post', 'put'], 'blog/add', [\App\Http\Controllers\Backend\BlogController::class, 'add'])->name('admin.blog.add');
            Route::match(['get', 'post', 'put', 'delete'], 'blog/edit/{page}', [\App\Http\Controllers\Backend\BlogController::class, 'action'])->name('admin.blog.edit');

            // admin main menu
            Route::get('menu/', [\App\Http\Controllers\Backend\MenuController::class, 'list'])->name('admin.menu.index');
            Route::match(['get', 'post', 'put'], 'menu/add', [\App\Http\Controllers\Backend\MenuController::class, 'create'])->name('admin.menu.add');
            Route::match(['get', 'post', 'put', 'delete'], 'menu/edit/{page}', [\App\Http\Controllers\Backend\MenuController::class, 'edit'])->name('admin.menu.edit');

        });
    });

    // Non-admin routes go here
    /* USER */
    Route::get('/kijelentkezes', [UserController::class, 'logout'])->name('logout');
    Route::get('/add-favourite/{adId}', [UserController::class, 'addFavourite']);
    Route::get('/remove-favourite/{adId}', [UserController::class, 'removeFavourite']);
});

Route::get('/{slug}', [PageController::class, 'show']);
