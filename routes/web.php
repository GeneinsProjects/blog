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

/**Ani e butang for dili na neeed login pages**/

Route::get('about', function(){
	return view('about');
});


/**Ani e butang ang need ug login pages**/
Route::group(['middleware' => ['auth']], function () {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('users', 'UsersController');
	Route::get('all-users', 'UsersController@all');


});