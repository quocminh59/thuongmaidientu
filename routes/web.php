<?php

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

Route::get('/administrator/{any?}',function(){
    return view("admin.dashboard");
})->where('any','^[\/\w\.\,-]*');

// Route for authenticate user
Route::namespace('User\Auth')->group(function(){
    Route::get('auth/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('auth/register', 'RegisterController@register');
    Route::get('auth/login', 'LoginController@showLoginForm')->name('login');
    Route::post('auth/login', 'LoginController@login');
    Route::post('auth/logout','LoginController@logout')->name('logout');
});

// Route homepage
Route::get('/', 'HomeController@index')->name('home');

// // Route about product detail
Route::get('/product/{slug}', 'HomeController@ShowProductDetail')->name('show.productdetail');

Route::group(['middleware' => 'cor'], function() {
    Route::get('/cart', 'CartController@index')->name('show.cart');
    Route::post('/addcart/{id}', 'CartController@AddCart')->name('addcart');
    Route::post('/updatecart/{id}/{quantity}', 'CartController@UpdateCart')->name('update.cart');
    Route::post('/virtualdellall', 'CartController@VirtualDeleteAll')->name('virtualdel.cart');
    Route::post('/virtualdellitem/{id}', 'CartController@VirtualDeleteItem')->name('virtualitem.cart');
    Route::post('/restoredellitem/{id}', 'CartController@RestoreDeleteItem')->name('restoredellitem.cart');
    Route::post('/dellall', 'CartController@DeleteAll')->name('deleteall.cart');
});

Route::get('/test', function() {
    return view('pages.order-info');
});



// Auth::routes();