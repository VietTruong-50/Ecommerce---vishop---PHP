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

Route::get('/', 'AdminController@loginAdmin')->name('admin.showLogin');
Route::get('/admin', 'AdminController@loginAdmin')->name('admin.showLogin');
Route::post('/admin', 'AdminController@login')->name('admin.login');
Route::get('/logout', 'AdminController@logout')->name('admin.logout');


Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {
    //Category
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories.index')->middleware('can:category-list');;
        Route::get('/create', 'CategoryController@create')->name('categories.create')->middleware('can:category-add');
        Route::post('/store', 'CategoryController@store')->name('categories.store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('categories.edit')->middleware('can:category-edit');
        Route::post('/update/{id}', 'CategoryController@update')->name('categories.update');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('categories.delete')->middleware('can:category-delete,id');;
    });

    //Menu
    Route::prefix('menus')->group(function () {
        Route::get('/', 'MenuController@index')->name('menus.index')->middleware('can:menu-list');
        Route::get('/create', 'MenuController@create')->name('menus.create');
        Route::post('/store', 'MenuController@store')->name('menus.store');
        Route::get('/edit/{id}', 'MenuController@edit')->name('menus.edit');
        Route::post('/update/{id}', 'MenuController@update')->name('menus.update');
        Route::get('/delete/{id}', 'MenuController@delete')->name('menus.delete');
    });

    //Product
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index')->name('products.index');
        Route::get('/create', 'ProductController@create')->name('products.create');
        Route::post('/store', 'ProductController@store')->name('products.store');
        Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
        Route::post('/update/{id}', 'ProductController@update')->name('products.update');
        Route::get('/delete/{id}', 'ProductController@delete')->name('products.delete');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', 'SliderController@index')->name('sliders.index');
        Route::get('/create', 'SliderController@create')->name('sliders.create');
        Route::post('/store', 'SliderController@store')->name('sliders.store');
        Route::get('/edit/{id}', 'SliderController@edit')->name('sliders.edit');
        Route::post('/update/{id}', 'SliderController@update')->name('sliders.update');
        Route::get('/delete/{id}', 'SliderController@delete')->name('sliders.delete');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', 'SettingController@index')->name('setting.index');
        Route::get('/create', 'SettingController@create')->name('setting.create');
        Route::post('/store', 'SettingController@store')->name('setting.store');
        Route::get('/edit/{id}', 'SettingController@edit')->name('setting.edit');
        Route::post('/update/{id}', 'SettingController@update')->name('setting.update');
        Route::get('/delete/{id}', 'SliderController@delete')->name('setting.delete');

    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'AdminUserController@index')->name('user.index');
        Route::get('/create', 'AdminUserController@create')->name('user.create');
        Route::post('/store', 'AdminUserController@store')->name('user.store');
        Route::get('/edit/{id}', 'AdminUserController@edit')->name('user.edit');
        Route::post('/update/{id}', 'AdminUserController@update')->name('user.update');
        Route::get('/delete/{id}', 'AdminUserController@delete')->name('user.delete');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', 'AdminRoleController@index')->name('roles.index');
        Route::get('/create', 'AdminRoleController@create')->name('roles.create');
        Route::post('/store', 'AdminRoleController@store')->name('roles.store');
        Route::get('/edit/{id}', 'AdminRoleController@edit')->name('roles.edit');
        Route::post('/update/{id}', 'AdminRoleController@update')->name('roles.update');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/create', 'AdminRoleController@createPermission')->name('permissions.create');
        Route::post('/store', 'AdminPermissionController@store')->name('permissions.store');

    });
});

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

