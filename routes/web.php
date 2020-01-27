<?php


use Illuminate\Support\Facades\Route;

// HomePage
Route::get('/', 'PagesController@index')->name('index');

// Contact Us
Route::get('/contact', 'SendEmailController@index')->name('contact');
Route::post('/sendmail/send', 'SendEmailController@send');

// Frontend Product Routes
Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@index')->name('products');
    Route::get('/{slug}', 'ProductController@show')->name('product.show');
    Route::get('/new/search', 'PagesController@search')->name('search');

    // Category Route
    Route::get('/categories', 'CategoriesController@index')->name('categories.index');
    Route::get('/category/{id}', 'CategoriesController@show');
});

// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/pages/index', 'AdminController@index')->name('admin.pages.index');

    // Admin Login Routes
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::get('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
    Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
    // Password Email Send
    Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/resetPost', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Password Reset
    Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.reset.post');

    // Product Routes
    Route::group(['prefix'=> '/product'], function(){
        Route::get('/index', 'AdminProductController@index')->name('admin.product.index');
        Route::get('/create', 'AdminProductController@create')->name('admin.product.create');
        Route::get('/edit/{id}', 'AdminProductController@edit')->name('admin.product.edit');
        Route::post('/update/{id}', 'AdminProductController@update')->name('admin.product.update');
        Route::post('/delete/{id}', 'AdminProductController@delete')->name('admin.product.delete');
        Route::post('/store', 'AdminProductController@store')->name('admin.product.store');

    });

    // Orders Routes
    Route::group(['prefix' => '/orders'], function () {
        Route::get('/', 'OrdersController@index')->name('admin.orders');
        Route::get('/view/{id}', 'OrdersController@show')->name('admin.order.show');
        Route::post('/delete/{id}', 'OrdersController@delete')->name('admin.order.delete');

        Route::post('/completed/{id}', 'OrdersController@completed')->name('admin.order.completed');
        Route::post('/paid/{id}', 'OrdersController@paid')->name('admin.order.paid');
        Route::post('/charge-update/{id}', 'OrdersController@chargeUpdate')->name('admin.order.charge');
        Route::get('/invoice/{id}', 'OrdersController@generateInvoice')->name('admin.order.invoice');
    });

    // Category Routes
    Route::group(['prefix' => '/category'], function () {
        Route::get('/index', 'AdminCategoryController@index')->name('admin.category.index');
        Route::get('/create', 'AdminCategoryController@create')->name('admin.category.create');
        Route::get('/edit/{id}', 'AdminCategoryController@edit')->name('admin.category.edit');
        Route::post('/update/{id}', 'AdminCategoryController@update')->name('admin.category.update');
        Route::post('/delete/{id}', 'AdminCategoryController@delete')->name('admin.category.delete');
        Route::post('/store', 'AdminCategoryController@store')->name('admin.category.store');
    });

    // Brand Routes
    Route::group(['prefix' => '/brands'], function () {
        Route::get('/index', 'BrandsController@index')->name('admin.brands.index');
        Route::get('/create', 'BrandsController@create')->name('admin.brands.create');
        Route::get('/edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
        Route::post('/update/{id}', 'BrandsController@update')->name('admin.brands.update');
        Route::post('/delete/{id}', 'BrandsController@delete')->name('admin.brands.delete');
        Route::post('/store', 'BrandsController@store')->name('admin.brands.store');
    });

    // Division Routes
    Route::group(['prefix' => '/divisions'], function () {
        Route::get('/index', 'DivisionsController@index')->name('admin.divisions.index');
        Route::get('/create', 'DivisionsController@create')->name('admin.divisions.create');
        Route::get('/edit/{id}', 'DivisionsController@edit')->name('admin.divisions.edit');
        Route::post('/update/{id}', 'DivisionsController@update')->name('admin.divisions.update');
        Route::post('/delete/{id}', 'DivisionsController@delete')->name('admin.divisions.delete');
        Route::post('/store', 'DivisionsController@store')->name('admin.divisions.store');
    });

    // District Routes
    Route::group(['prefix' => '/districts'], function () {
        Route::get('/index', 'DistrictsController@index')->name('admin.districts.index');
        Route::get('/create', 'DistrictsController@create')->name('admin.districts.create');
        Route::get('/edit/{id}', 'DistrictsController@edit')->name('admin.districts.edit');
        Route::post('/update/{id}', 'DistrictsController@update')->name('admin.districts.update');
        Route::post('/delete/{id}', 'DistrictsController@delete')->name('admin.districts.delete');
        Route::post('/store', 'DistrictsController@store')->name('admin.districts.store');
    });

    // Slider Routes
    Route::group(['prefix' => '/sliders'], function () {
        Route::get('/', 'SlidersController@index')->name('admin.sliders');
        Route::post('/store', 'SlidersController@store')->name('admin.slider.store');
        Route::post('slider/edit/{id}', 'SlidersController@update')->name('admin.slider.update'); 
        Route::post('/delete/{id}', 'SlidersController@delete')->name('admin.slider.delete');
    });
});

// Authentication
Auth::routes();

Route::get('/logout', function () {
    auth()->logout();
    echo "Logout successfull.";
    return redirect()->to('/login');
});

// User Routes
Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', 'UsersController@dashboard')->name('user.dashboard');
    Route::get('/profile', 'UsersController@profile')->name('user.profile');
    Route::post('/profile/update', 'UsersController@profileUpdate')->name('user.profile.update');
});

Route::get('/token/{token}', 'VerificationController@verify')->name('user.verification');

// Carts Routes
Route::group(['prefix' => 'carts'], function () {
    Route::get('/', 'CartsController@index')->name('carts');
    Route::post('/store', 'CartsController@store')->name('carts.store');
    Route::post('/update/{id}', 'CartsController@update')->name('carts.update');
    Route::post('/delete/{id}', 'CartsController@destroy')->name('carts.delete');
});

// Checkout Routes
Route::group(['prefix' => 'checkout'], function () {
    Route::get('/', 'CheckoutsController@index')->name('checkouts');
    Route::post('/store', 'CheckoutsController@store')->name('checkouts.store');
});

// API Routes
Route::get('get-districts/{id}', function($id){
    return json_encode(App\District::where('division_id', $id)->get());
});