<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group( [ 'middleware' => ['basicAuth'] ], function() {

Route::resource('customers','Api\CustomerController');
Route::resource('users','Api\UsersController');
Route::resource('category','Api\CategoryController');
Route::resource('subCategory','Api\SubCategoryController');
Route::resource('products','Api\ProductController');
Route::resource('taxRules','Api\TaxesController');

});

Route::get('getSubCategory','Api\SubCategoryController@getSubCategory');
Route::get('getCategoryList','Api\CategoryController@getCategoryList');
Route::get('roles','Api\UsersController@getRles');
Route::get('country','Api\UsersController@getCountry');


Route::get('categoryList','Api\FetchDataController@getCategoryList');
Route::get('subCategoryList','Api\FetchDataController@getsubCategoryList');



Route::get('productList','Api\ProductController@productList');



Route::post('uploadProfilePicture','Api\CustomerController@uploadProfilePicture');
Route::post('upload','Api\CustomerController@uploadProfilePicture');
