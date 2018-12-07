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


Route::get('/main', 'MainPageController@ShowList');
Route::get('/profile{id}', 'ProfileController@ShowProfile');
Route::post('/profile{teacher_id}/review', 'ProfileController@AddReview');
Route::get('/profile{id}/delete_rev/{rev_id}', 'ProfileController@DeleteReview');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
