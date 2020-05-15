<?php

use App\Models\inputOption;
use App\Models\inputValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/home', 'HomeController@index')->name('home');

/*Social Login Routes*/
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

/* For Password reset operations*/
Route::group([ 'middleware' => 'api', 'prefix' => 'password'], function () {
    Route::post('create', 'API\PasswordResetController@create');
    Route::get('find/{token}', 'API\PasswordResetController@find');
    Route::post('reset', 'API\PasswordResetController@reset');
});

Route::get('pola', 'API\Users@getAllUsers');

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





/* Cruds  Routes */
Route::resource('categories','API\CategoryApi');
Route::resource('subcategories','API\SubCategoryAPI');
Route::resource('inputs','API\InputsAPI');
Route::resource('tags','API\TagsAPI');



/* Filters Routes */
Route::get('filter/categories','API\CategoryApi@indexWithFilter');
Route::get('filter/tags','API\TagsAPI@indexWithFilter');
Route::get('filter/inputs','API\InputsAPI@indexWithFilter');
Route::get('filter/subcategories','API\SubCategoryAPI@indexWithFilter');


/* Relations ships  Routes */

Route::post('subcategories/inputs','API\SubCategoryAPI@subcats_inputs');


/* Get All Inputs Id's Realted to a subcat */
Route::get('subcatsinputs/{id}','API\SubCategoryAPI@all_subcatsids');





//Route::get('pola',function (){
//    $row=App\Models\Input::find(47);
//
//    if(!$row)
//        dd('No Row');
//    foreach($row->optionsValidators as $valid){
//        $xx=inputValidator::find($valid->id);
//        echo '<br>'.$valid->id.' : '.$xx->delete().'<br>';
//    }
////    foreach($row->optionsInputs() as $option){
////        inputOption::destroy($option->id);
////    }
//});
