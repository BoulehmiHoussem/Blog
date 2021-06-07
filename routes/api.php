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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//force cors and json headers
Route::group(['middleware' => ['cors', 'json.response']], function () {
        Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    	Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
    	Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    	
});


Route::group(
	['middleware' => ['auth:api', 'cors', 'json.response']],
	function () {
		//articles api's
		Route::get('/articles', 'ArticlesController@index')->name('Articles.api');
    	Route::post('/articles/delete/{id}', 'ArticlesController@destroy')->name('Articlesdelete.api');
    	Route::post('/articles/update/{id}', 'ArticlesController@edit')->name('Articlesedit.api');
    	Route::post('/articles/create', 'ArticlesController@create')->name('Articlescreate.api');


    	//comments api's
    	
	}
);


