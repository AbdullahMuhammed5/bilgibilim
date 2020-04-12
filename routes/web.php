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
Route::group(['namespace' => 'Home'], function (){
    Route::get('/contact', 'ContactController@index')->name('front.contact');
    Route::post('/sendContact', 'ContactController@sendContact')->name('front.sendContact');
    Route::resource('home-headers', 'HomeHeadersController')->only(['index', 'update', 'edit']);
    Route::resource('footer-links', 'FooterLinksController')->only(['index', 'update', 'edit']);
});
Route::get('/search', 'HomeController@search')->name('front.search');

// resources
Route::resource('cities', 'CityController');
Route::resource('roles', 'RoleController');
Route::resource('staffs', 'StaffController');
Route::resource('news', 'NewsController');
Route::resource('jobs', 'JobController');
Route::resource('images', 'ImageController');

Route::resource('categories', 'CategoryController')->except('show');
Route::get('/categories/{name}', 'CategoryController@getByCategory')->name('front.category');


// Toggle buttons APIs
Route::put('toggleStaffStatus/{staff}', 'StaffController@toggleActivity')->name('staffToggleStatus');
Route::put('togglePublishNews/{news}', 'NewsController@togglePublishing')->name('togglePublishNews');
Route::put('toggleFeatured/{news}', 'NewsController@toggleFeatured')->name('toggleFeatured');

// File uploads APIs
Route::prefix('files')->group(function() {
    Route::post('ckEditorUpload', 'FileUploadController@ckEditorUpload')->name('upload');
    Route::post('store', 'FileUploadController@fileStore');
    Route::post('delete', 'FileUploadController@fileDestroy');
    Route::get('getFiles/{id}/{type}', 'FileUploadController@getFiles')->name('files.getFiles');
});

// get data
Route::get('/getCities/{id}','CityController@getCities');
Route::get('/getAuthorsByJob/{id}','StaffController@getAuthorsByJob');
Route::get('/getRelated','NewsController@getRelated');
