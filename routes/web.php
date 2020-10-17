<?php

use App\Http\Controllers\Panel\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('site.index');
// });

    Route::get('/', 'Site\SiteController@index')->name('index');
    Route::get('/shop', 'Site\SiteController@shop')->name('shop');
    Route::get('/about', 'Site\SiteController@about')->name('about');
    Route::get('/blog', 'Site\SiteController@blog')->name('blog');
    Route::get('/contact', 'Site\SiteController@contact')->name('contact');
    Route::get('/wishlist', 'Site\SiteController@wishlist')->name('wishlist');
    Route::get('/panel/contact', 'Site\ContactController@index')->name('panel.contact.index')->middleware('auth');
    Route::post('/contact', 'Site\ContactController@store')->name('contact.store');

    // Route::name('post.')->group(['prefix' => '/blog'], function () {
    Route::get('/post/single/{slug}', 'Site\BlogController@single')->name('post.single');
    Route::get('/post/category/{id}', 'Site\BlogController@categoryPost')->name('post.category');
    Route::get('/post/tag/{slug}', 'Site\BlogController@tagPost')->name('post.tag');
    Route::get('/post/user/{id}', 'Site\BlogController@userPost')->name('post.user');

    Route::get('/post/search', 'Site\BlogController@search')->name('post.search');
    // });

    Route::get('/single/{slug}', 'Site\ShopController@show')->name('shop.single');
    Route::get('/category/{id}', 'Site\ShopController@categoryProduct')->name('shop.category');

    Route::get('/wishlist/add/{id}', 'Site\WishlistController@add')->name('wishlist.add');
    Route::get('/wishlist/remove/{id}', 'Site\WishlistController@remove')->name('wishlist.remove');

    // Route::post('/product/add/cart/{id}', 'Site\ProductController@addToCart')->name('product.add.cart');

    // Route::get('/cart', 'Site\CartController@getCart')->name('cart');
    Route::get('/cart/clear', 'Site\CartController@clearCart')->name('cart.clear');

    Route::group(['prefix' => '/cart', 'middleware' => ['auth']], function () {      //'middleware' => ['auth','verified']]
		Route::get('/', 'Site\CartController@index')->name('cart');
		Route::get('/product/{slug}', 'Site\CartController@add')->name('cart.add');
        Route::post('/product/single/{slug}', 'Site\CartController@addSingle')->name('cart.add.single');
        Route::get('/cart/item/{id}/remove', 'Site\CartController@removeItem')->name('cart.remove');
		// Route::get('/product', 'Site\CartController@index'); // handling only
		// Route::get('/product/delete/{id}', 'Site\CartController@addToDelete')->name('cart.delete');
		Route::post('/product/update/{id}', 'Site\CartController@addToUpdate')->name('cart.update');
        Route::get('/checkout', 'Site\CartController@checkout')->name('cart.checkout');
        Route::post('/coupon', 'Site\CartController@couponApply')->name('coupon');
        Route::get('/coupon/remove', 'Site\CartController@couponRemove')->name('coupon.remove');
		// Route::post('/order', 'OrderController@store')->name('cart.order');
	});

Auth::routes();

Route::namespace('Panel')->prefix('home')->group(function() {
    Route::view('/', 'panel.dashboard.index')->name('home')->middleware('auth');
    Route::name('panel.')->group(function() {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']])->middleware('can:manage-users');
        Route::resource('/roles', 'RolesController', ['except' => ['show', 'create']])->middleware('can:manage-users');
        // Route::resource('/categories', 'CategoryController');
        Route::group(['prefix'  =>   'categories'], function() {
            Route::get('/', 'CategoryController@index')->name('categories.index');
            Route::get('/create', 'CategoryController@create')->name('categories.create');
            Route::post('/store', 'CategoryController@store')->name('categories.store');
            Route::get('/{id}/edit', 'CategoryController@edit')->name('categories.edit');
            Route::post('/update/{id}', 'CategoryController@update')->name('categories.update');
            Route::get('/{id}/delete', 'CategoryController@delete')->name('categories.delete');
        });
        Route::group(['prefix'  =>   'partners'], function() {
            Route::get('/', 'PartnerController@index')->name('partners.index');
            Route::get('/create', 'PartnerController@create')->name('partners.create');
            Route::post('/store', 'PartnerController@store')->name('partners.store');
            Route::get('/{id}/edit', 'PartnerController@edit')->name('partners.edit');
            Route::post('/update/{id}', 'PartnerController@update')->name('partners.update');
            Route::get('/{id}/delete', 'PartnerController@delete')->name('partners.delete');
        });
        Route::group(['prefix'  =>   'banners'], function() {
            Route::get('/', 'BannerController@index')->name('banners.index');
            Route::get('/create', 'BannerController@create')->name('banners.create');
            Route::post('/store', 'BannerController@store')->name('banners.store');
            Route::get('/{id}/edit', 'BannerController@edit')->name('banners.edit');
            Route::post('/update/{id}', 'BannerController@update')->name('banners.update');
            Route::get('/{id}/delete', 'BannerController@delete')->name('banners.delete');
        });
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@index')->name('products.index');
            Route::get('/create', 'ProductController@create')->name('products.create');
            Route::post('/store', 'ProductController@store')->name('products.store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
            Route::post('/update/{id}', 'ProductController@update')->name('products.update');
            Route::get('/{id}/delete', 'ProductController@delete')->name('products.delete');
        });
        Route::group(['prefix' =>   'testimonies'], function() {
            Route::get('/', 'TestimonyController@index')->name('testimonies.index');
            Route::get('/edit/{id}', 'TestimonyController@edit')->name('testimonies.edit');
            Route::post('/update/{id}', 'TestimonyController@update')->name('testimonies.update');
            Route::get('/delete/{id}', 'TestimonyController@delete')->name('testimonies.delete');
        });
        Route::group(['prefix' =>   'coupon'], function() {
            Route::get('/', 'CouponController@index')->name('coupon.index');
            Route::get('/create', 'CouponController@create')->name('coupon.create');
            Route::post('/store', 'CouponController@store')->name('coupon.store');
            Route::get('/edit/{id}', 'CouponController@edit')->name('coupon.edit');
            Route::post('/update/{id}', 'CouponController@update')->name('coupon.update');
            Route::get('/delete/{id}', 'CouponController@delete')->name('coupon.delete');
        });
        Route::group(['prefix' =>   'order'], function() {
            Route::get('/', 'OrderController@index')->name('order.index');
            Route::get('/edit/{id}', 'OrderController@edit')->name('order.edit');
            Route::get('/payment/complete/{id}', 'OrderController@paid')->name('order.paid');
            Route::get('/payment/decline/{id}', 'OrderController@unpay')->name('order.unpay');
            Route::get('/complete/{id}', 'OrderController@completed')->name('order.completed');
            Route::get('/process/{id}', 'OrderController@processing')->name('order.processing');
            Route::get('/decline/{id}', 'OrderController@decline')->name('order.declined');
            Route::get('/delete/{id}', 'OrderController@delete')->name('order.delete');
            Route::post('/store', 'OrderController@store')->name('order.store');
        });
        Route::group(['prefix' =>   'blog'], function() {
            Route::get('/', 'BlogController@index')->name('blog');
            Route::group(['prefix'  =>   'post-categories'], function() {
                // Route::get('/', 'PostCategoryController@index')->name('post-categories.index');
                Route::get('/create', 'PostCategoryController@create')->name('post-categories.create');
                Route::post('/store', 'PostCategoryController@store')->name('post-categories.store');
                Route::get('/{id}/edit', 'PostCategoryController@edit')->name('post-categories.edit');
                Route::post('/update/{id}', 'PostCategoryController@update')->name('post-categories.update');
                Route::get('/{id}/delete', 'PostCategoryController@delete')->name('post-categories.delete');
            });
            Route::group(['prefix'  =>   'tags'], function() {
                // Route::get('/', 'TagController@index')->name('post-categories.index');
                Route::get('/create', 'TagController@create')->name('tag.create');
                Route::post('/store', 'TagController@store')->name('tag.store');
                Route::get('/{id}/edit', 'TagController@edit')->name('tag.edit');
                Route::post('/update/{id}', 'TagController@update')->name('tag.update');
                Route::get('/{id}/delete', 'TagController@delete')->name('tag.delete');
            });
            Route::group(['prefix'  =>   'post'], function() {
                // Route::get('/', 'PostController@index')->name('post-categories.index');
                Route::get('/create', 'PostController@create')->name('post.create');
                Route::post('/store', 'PostController@store')->name('post.store');
                Route::get('/{id}/edit', 'PostController@edit')->name('post.edit');
                Route::post('/update/{id}', 'PostController@update')->name('post.update');
                Route::get('/{id}/delete', 'PostController@delete')->name('post.delete');
            });
        });

    });
    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::post('/settings', 'SettingController@update')->name('settings.update');
});

Route::get('/product/{slug}', 'Site\ProductController@show')->name('product.show');
