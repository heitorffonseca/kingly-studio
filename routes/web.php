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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'check.user'])->prefix('dashboard')->name('dashboard')->group(function(){

    Route::get('/', 'HomeController@index')->name('.home');
    Route::post('/', 'InvoiceController@store')->name('.store');

});

Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin')->group(function(){

    Route::get('/', 'AdminController@index')->name('.home');

    Route::middleware(['check.list_users'])->prefix('users')->name('.users')->group(function(){

        Route::get('/', 'AdminController@users')->name('.home');

        Route::middleware(['check.store_user'])->get('/create', 'AdminController@createUser')->name('.create');
        Route::middleware(['check.store_user'])->post('/create', 'UserController@store')->name('.store');

        Route::middleware(['check.update_user'])->get('/{uuid}/edit', 'AdminController@editUser')->name('.edit');
        Route::middleware(['check.update_user'])->put('/{uuid}/edit', 'UserController@update')->name('.update');

        Route::middleware(['check.destroy_user'])->get('/{uuid}/destroy', 'UserController@destroy')->name('.destroy');

        Route::middleware(['check.view_user'])->get('/{uuid}', 'AdminController@showUser')->name('.view');
    });

    Route::middleware(['check.list_profiles'])->prefix('profiles')->name('.profiles')->group(function(){

        Route::get('/', 'AdminController@profiles')->name('.home');

        Route::middleware(['check.store_profile'])->get('/create', 'AdminController@createProfile')->name('.create');
        Route::middleware(['check.store_profile'])->post('/create', 'ProfileController@store')->name('.store');

        Route::middleware(['check.update_profile'])->get('/{uuid}/edit', 'AdminController@editProfile')->name('.edit');
        Route::middleware(['check.update_profile'])->put('/{uuid}/edit', 'ProfileController@update')->name('.update');

        Route::middleware(['check.destroy_profile'])->get('/{uuid}/destroy', 'ProfileController@destroy')->name('.destroy');

        Route::middleware(['check.view_profile'])->get('/{uuid}', 'AdminController@showProfile')->name('.view');

    });

    Route::middleware(['check.list_invoices'])->prefix('invoices')->name('.invoices')->group(function(){

        Route::get('/', 'AdminController@invoices')->name('.home');

        Route::middleware(['check.validate_invoice'])->get('/{uuid}/validate', 'InvoiceController@validateInvoice')->name('.validate');

        Route::middleware(['check.destroy_invoice'])->get('/{uuid}/destroy', 'InvoiceController@destroy')->name('.destroy');

        Route::middleware(['check.view_invoice'])->get('/{uuid}', 'AdminController@showInvoice')->name('.view');

    });

});

