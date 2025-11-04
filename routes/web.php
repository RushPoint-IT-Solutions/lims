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
    Route::post('delete_rack/{id}', 'RackController@destroy')->name('delete_rack');

    // Branches
    Route::get('/branches', 'BranchController@index')->name('branches');
    Route::post('/new_branch', 'BranchController@store')->name('branches.store');
    Route::post('update_branch/{id}', 'BranchController@update');
    Route::post('delete_branch/{id}', 'BranchController@destroy')->name('delete_branch');

    // Types
    Route::get('/types', 'TypeController@index')->name('types');
    Route::post('/new_type', 'TypeController@store')->name('types.store');
    Route::post('update_type/{id}', 'TypeController@update');
    Route::post('delete_type/{id}', 'TypeController@destroy')->name('delete_type');

    // Rooms
    Route::get('/rooms', 'RoomController@index')->name('rooms');
    Route::post('/new_room', 'RoomController@store')->name('rooms.store');
    Route::post('update_room/{id}', 'RoomController@update');
    Route::post('delete_room/{id}', 'RoomController@destroy')->name('delete_room');

    // Frameworks 
    Route::get('/frameworks', 'FrameworkController@index')->name('frameworks');
    Route::post('/new_framework', 'FrameworkController@store')->name('frameworks.store');
    Route::post('update_framework/{id}', 'FrameworkController@update');
    Route::post('delete_framework/{id}', 'FrameworkController@destroy')->name('delete_framework');
});


Route::get('password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('password/reset', function () {
    return redirect()->route('password.otp');
})->name('password.email');

Route::get('password/otp', function () {
    return view('auth.passwords.otp');
})->name('password.otp');

Route::post('password/otp', function () {
    return redirect()->route('password.customreset');
})->name('password.verify');

Route::get('password/custom-reset', function () {
    return view('auth.passwords.reset');
})->name('password.customreset');

//acquisition
Route::get('/acquisition', 'AcquisitionController@index')->name('acquisition');

//cataloging and metadata
Route::get('/catalog_metadata', 'CatalogMetadataController@index')->name('catalog_metadata');

//circulation
Route::get('/circulation', 'CirculationController@index')->name('circulation');

//user
Route::get('/users', 'UserController@index')->name('users');

//report and analytics
Route::get('/report_analytics', 'ReportAnalyticsController@index')->name('report_analytics');

//penalty computation
Route::get('/penalty_computation', 'PenaltyComputationController@index')->name('penalty_computation');

//reservation
Route::get('/reservation', 'ReservationController@index')->name('reservation');

//admin configuration
Route::get('/admin_configuration', 'AdminConfigurationController@index')->name('admin_configuration');

//reports
Route::get('/reports', 'ReportsController@index')->name('reports');

//e-resources
Route::get('/e_resources', 'EResourcesController@index')->name('e_resources');


