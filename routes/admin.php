<?php
Route::namespace('Admin\Auth')->group(function(){
    Route::get('/auth/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/auth/login', 'LoginController@login');
    Route::post('/auth/logout','LoginController@logout')->name('admin.logout');
});


Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function() {
    Route::get('/','AdminController@index')->name('admin.home');

    //Route cho Category
    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::post('category/create', 'CategoryController@store')->name('category.store');
    Route::get('category/recursive', 'CategoryController@showCategoriesRecursive')->name('category.recursive');
    Route::get('category/recursive/sub/{id}', 'CategoryController@showSubCategories')->name('category.recursive.sub');
    Route::get('category/recursive/showsub/{id}', 'CategoryController@showSubCategoriesRecursive')->name('category.recursive.showsub');
    Route::get('category/show/{id}', 'CategoryController@show')->name('category.show');
    Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
    Route::post('category/delete/{id}', 'CategoryController@destroy')->name('category.destroy');
    
    //Route cho Brand
    Route::get('brand', 'BrandController@index')->name('brand.index');
    Route::post('brand/create', 'BrandController@store')->name('brand.store');
    Route::get('brand/show/{id}', 'BrandController@show')->name('brand.show');
    Route::post('brand/update/{id}', 'BrandController@update')->name('brand.update');
    Route::post('brand/delete/{id}', 'BrandController@destroy')->name('brand.destroy');

     //Route cho Product
    Route::get('product/{id}', 'ProductController@index')->name('product.index');
    Route::post('product/create', 'ProductController@store')->name('product.store');
    Route::get('product/show/{id}', 'ProductController@show')->name('product.show');
    Route::get('product/showtags/{id}','ProductController@showTags')->name('product.showtags');
    Route::get('product/showcategories/{id}','ProductController@showCategory')->name('product.showcategories');
    Route::get('product/showsubimages/{id}', 'ProductController@showSubImage')->name('product.showsubimages');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
});


