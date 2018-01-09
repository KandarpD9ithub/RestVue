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
/*Personal access client created successfully.
Client ID: 1
Client Secret: 4lYBMWSmjCM0JhYOL1xPOV3wpIr7S8CbKC6eGFLi
Password grant client created successfully.
Client ID: 2
Client Secret: pQzMSqShiGYfPs7UVflF6kvJ17sWG3gopBQ5Sx58
 
 Client ID: 3
Client Secret: Dv2cYRqq4B7i5IqEhKHYvtif5FfC1UTXMDqBzjNn
*/
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::resource('customers','Api\CustomerController');
Route::resource('users','Api\UsersController');
Route::resource('category','Api\CategoryController');
Route::resource('subCategory','Api\SubCategoryController');
Route::resource('products','Api\ProductController');
Route::resource('taxRules','Api\TaxesController');
Route::resource('discounts','Api\DiscountController');
Route::resource('tables','Api\TablesController');
Route::resource('orders','Api\OrderController');


Route::get('getSubCategory','Api\SubCategoryController@getSubCategory');
Route::get('getCategoryList','Api\CategoryController@getCategoryList');
Route::get('roles','Api\UsersController@getRles');
Route::get('country','Api\UsersController@getCountry');


Route::get('categoryList','Api\FetchDataController@getCategoryList');
Route::get('subCategoryList/{id}','Api\FetchDataController@getsubCategoryList');
Route::get('types','Api\FetchDataController@');


Route::get('productList','Api\ProductController@productList');

Route::get('subProductList/{id}','Api\ProductController@subProductList');

Route::get('catProductList/{id}','Api\ProductController@catProductList');



Route::post('uploadProfilePicture','Api\CustomerController@uploadProfilePicture');
Route::post('upload','Api\CustomerController@uploadProfilePicture');
Route::post('Login','Api\FetchDataController@Login');

Route::get('search','Api\ProductController@searchProduct');
Route::get('getProduct/{id}','Api\ProductController@show');

Route::post('checkProductExist','Api\ProductController@checkProductExist');

Route::get('searchCustomer','Api\CustomerController@searchCustomer');
Route::get('getCustomer/{id}','Api\CustomerController@show');
