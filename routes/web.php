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
    return view('users.login');
});
Route::resource('Login','LoginController');

Route::group( [ 'middleware' => [ 'auth','web' ] ], function() {

	Route::get('/home', function () {
	    return view('restaurant.index');
	});
	Route::get('customers','BackEnd\ShowController@showCustomer');
	Route::get('users','BackEnd\ShowController@showUsers');
	Route::get('category','BackEnd\ShowController@showCategory');
	Route::get('subCategories','BackEnd\ShowController@showSubCategories');
	Route::get('logOut',function(){
		Auth::logout();
		return redirect()->to('/');
	});

});
