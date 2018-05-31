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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/articles", ["as" => "all_articles", "uses" => "ArticleController@index"]);
Route::get("/articles/{id}", ["as" => "show_article", "uses" => "ArticleController@show"]);
Route::post("/articles", ["as" => "add_article", "uses" => "ArticleController@store"]);
Route::put("/articles/{id}", ["as" => "update_article", "uses" => "ArticleController@update"]);
Route::delete("/articles/{id}", ["as" => "delete_article", "uses" => "ArticleController@destroy"]);
