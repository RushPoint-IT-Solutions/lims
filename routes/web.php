<?php
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Authors
    Route::get('authors', 'AuthorController@index')->name('authors');
    Route::post('/new_author', 'AuthorController@store')->name('authors.store');
    Route::post('/active/{id}', 'AuthorController@active')->name('authors.active');
    Route::post('/inactive/{id}', 'AuthorController@inactive')->name('authors.inactive');

    // Racks
    Route::get('racks', 'RackController@index')->name('racks');
    Route::post('/new_rack', 'RackController@store')->name('racks.store');
    Route::post('update_rack/{id}', 'RackController@update');
});