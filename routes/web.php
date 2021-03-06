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

Route::get('/aboutUs', 'MainPageController@AboutUs');

Route::get('/main', 'MainPageController@ShowList');
//Route::post('/main', 'MainPageController@ShowList');
Route::get('/profile{id}', 'ProfileController@ShowProfile');
Route::post('/profile{teacher_id}/review', 'ProfileController@AddReview');
Route::get('/profile{id}/delete_rev/{rev_id}', 'FeedbackController@DeleteReview');

Route::get('/main/delete_teacher{id}', 'MainPageController@DeleteTeacher');

Route::get('/main/edit_teacher{id}', 'MainPageController@EditTeacherView');
Route::post('/main/edit_teacher{id}', 'MainPageController@EditTeacher');

Route::get('/main/add_teacher', 'MainPageController@AddTeacherView');
Route::post('/main/add_teacher', 'MainPageController@AddTeacher');

Route::get('/main/{teacher_id}/like_from_main/{sort}', 'MainPageController@Like');
Route::post('/main/{teacher_id}/like_from_main/{sort}', 'MainPageController@ShowList');

Route::get('/main/{teacher_id}/dislike_from_main/{sort}', 'MainPageController@Dislike');
Route::post('/main/{teacher_id}/dislike_from_main/{sort}', 'MainPageController@ShowList');

Route::get('/main/{teacher_id}/like', 'MainPageController@Like');
Route::get('/main/{teacher_id}/dislike', 'MainPageController@Dislike');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('media/{dir}/{name}', 'MediaController@index');

Route::get('/main/feedback', 'FeedbackController@ShowFeedback');
Route::get('/main/requests', 'MainPageController@ShowRequests');
Route::get('/main/accept_rev/{id}', 'FeedbackController@Accept');
Route::get('/main/accept_user/{id}', 'ProfileController@Accept');
Route::get('/main/delete_user/{id}', 'ProfileController@Delete');
Route::get('/main/ban/{id}', 'ProfileController@Ban');


