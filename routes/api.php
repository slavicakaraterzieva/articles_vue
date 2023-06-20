<?php

use App\Http\Controllers\ArticleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get articles
Route::get('/articles', 'ArticleController@index');


//update article
Route::put('/article', 'ArticleController@store');

//delete article
Route::delete('/article/{id}', 'ArticleController@destroy');
//single article
Route::get('/article/{id}', 'ArticleController@show');

//create article
Route::post('/article', 'ArticleController@store');

?>

