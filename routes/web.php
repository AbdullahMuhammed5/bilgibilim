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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@front');
Route::get('/home', 'HomeController@front')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

// front
Route::get('/articles', 'HomeController@articles')->name('front.articles');
Route::get('/article/{news}', 'HomeController@article')->name('front.article');
Route::get('/news', 'HomeController@news')->name('front.news');
Route::get('/contact', 'HomeController@contact')->name('front.contact');



// Route group
Route::prefix('jobs')->group(function(){
    Route::get('', 'JobController@index')->name('jobs.index');
    Route::get('create', 'JobController@create')->name('jobs.create');
    Route::get('{job}', 'JobController@show')->name('jobs.show');
    Route::post('', 'JobController@store')->name('jobs.store');
    Route::get('{job}/edit', 'JobController@edit')->middleware('WriterAndReporter')->name('jobs.edit');
    Route::patch('{job}', 'JobController@update')->name('jobs.update');
    Route::delete('{job}', 'JobController@destroy')->middleware('WriterAndReporter')->name('jobs.destroy');
});

// resources
Route::resource('cities', 'CityController');
Route::resource('roles', 'RoleController');
Route::resource('staffs', 'StaffController');
Route::resource('news', 'NewsController');
Route::resource('folders', 'FolderController');
Route::resource('images', 'ImageController');


// Toggle buttons APIs
Route::put('toggleStaffStatus/{staff}', 'StaffController@toggleActivity')->name('staffToggleStatus');
Route::put('togglePublishNews/{news}', 'NewsController@togglePublishing')->name('togglePublishNews');
Route::put('toggleFeatured/{news}', 'NewsController@toggleFeatured')->name('toggleFeatured');

// File uploads APIs
Route::prefix('files')->group(function() {
    Route::post('store', 'FileUploadController@fileStore');
    Route::post('delete', 'FileUploadController@fileDestroy');
    Route::get('getFiles/{id}/{type}', 'FileUploadController@getFiles')->name('files.getFiles');
});

// get data
Route::get('/getCities/{id}','CityController@getCities');
Route::get('/getAuthorsByJob/{id}','StaffController@getAuthorsByJob');
Route::get('/getRelated','NewsController@getRelated');
