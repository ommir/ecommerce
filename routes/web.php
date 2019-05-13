<?php

// use Illuminate\Routing\Route;
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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::name('admin.')->group(function () {
	Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
		Route::resource('products', 'Admin\ProductController');
		Route::resource('orders', 'Admin\OrderController');
	});
});

Route::get('products', 'PublicController@index')->name('products.show');
Route::get('product/detail/{product}', 'PublicController@show')->name('products.detail');

Route::get('/', 'PublicController@indexUtama')->name('home');

Route::get('product/images', 'PublicController@images')->name('products.image');

Route::get('/carts', 'CartController@index')->name('carts.index');
Route::get('/carts/add/{id}', 'CartController@add')->name('carts.add');
Route::patch('/carts/update', 'CartController@update')->name('carts.update');
Route::delete('/carts/remove', 'CartController@remove')->name('carts.remove');

Route::post('posts', 'PublicController@store')->name('posts.review');

Route::get('/wp-admin', 'HomeController@index')->name('wp-admin');
