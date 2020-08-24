<?php

use Illuminate\Support\Facades\Route;

//\Illuminate\Support\Facades\Auth::loginUsingId(6);

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

Route::get('/', 'IndexController');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

// Profile routes...
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::put('/profile', 'HomeController@updateProfile');
Route::post('/profile/update-password', 'HomeController@changePassword');

Route::post('/role/{role}/remove/{user}', 'RoleController@remove')->name('remove-role');
Route::post('/role/assign/{user}', 'RoleController@assign')->name('assign-role');

// Country routes...
Route::resource('countries', 'CountryController');

// Region routes...
Route::resource('regions', 'RegionController');

// Province routes...
Route::resource('provinces', 'ProvinceController');

// Local Government Area routes...
Route::resource('local_government_areas', 'LocalGovernmentAreaController');

// City routes...
Route::resource('villages', 'VillageController');

// City routes...
Route::resource('cities', 'CityController');

// User routes...
Route::resource('users', 'UserController')->only(['index', 'destroy']);
