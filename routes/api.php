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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'API\Passport@login');
    Route::post('signup', 'API\Passport@signup');
    Route::get('signup/activate/{token}', 'API\Passport@signupActivate');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('user', 'API\Passport@details');
        Route::get('logout', 'API\Passport@logout');
        Route::post('update', 'API\Passport@update');
    });
});
Route::group([ 'middleware' => 'api', 'prefix' => 'password'], function () {
    Route::post('create', 'API\PasswordResetController@create');
    Route::get('find/{token}', 'API\PasswordResetController@find');
    Route::post('reset', 'API\PasswordResetController@reset');
});
Route::resource('categories','API\CategoryApi');
Route::post('categories/id',function ($id){
   $name="TOOOOOOOTA";
   $cat=\App\Models\Category::find($id);
   $cat->name=$name;
   $cat->save();
   dd($cat);
});
