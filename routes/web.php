<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Product', 'prefix' => 'products', 'middleware' => ['auth']], function() {
    Route::get('/', 'MainController@index')->name('product.index');
    Route::get('/create', 'MainController@create')->name('product.create');
    Route::post('/', 'MainController@store')->name('product.store');
    Route::get('/{product}', 'MainController@show')->name('product.show');
    Route::get('/{product}/edit', 'MainController@edit')->name('product.edit');
    Route::post('/{product}', 'MainController@update')->name('product.update');
    Route::delete('/{product}', 'MainController@delete')->name('product.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
