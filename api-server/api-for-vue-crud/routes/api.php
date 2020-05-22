<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->group(function () {
  /*product*/
    Route::post("login-register", "UserController@authentication");
    Route::get("/products", "ProductController@index");
    Route::post("product/store", "productController@store");
    Route::get("product/{id}", "ProductController@show");
    Route::get("product/delete/{id}", "ProductController@destroy");
    Route::get("product/edit/{id}", "ProductController@edit");
    Route::post("product/update/{id}", "ProductController@update");




	Route::get("students", "StudentController@index");
	Route::post("students/store", "StudentController@store");
	Route::post("students/update/{id}", "StudentController@update");
	Route::post("students/delete/{id}", "StudentController@destroy");
	Route::get("students/{id}", "StudentController@getData");

   Route::post("upload-image", "StudentController@uploadImage");
   Route::post("edit-image", "StudentController@editImage");
   Route::post("test", "StudentController@test");

});