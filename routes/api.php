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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'API\Passport@login');
    Route::post('signup', 'API\Passport@signup');
    Route::get('signup/activate/{token}', 'API\Passport@signupActivate');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('user', 'API\Passport@details');
        Route::get('logout', 'API\Passport@logout');
        Route::post('update', 'API\Passport@update');
        Route::resource('items','API\Items');
        Route::resource('items/values','API\ItemValues');


        Route::post('items/questions', 'API\Questions@store');
        Route::put('items/questions/{id}', 'API\Questions@update');
        Route::get('items/questions/{id}', 'API\Questions@show');


        Route::resource('requests', 'API\ItemsRequests');
        Route::post('requests/change/status', 'API\ItemsRequests@changeStatus');








        // Route::get('items/upoptions/{id}','API\Items@getAllItemOptions');


    });
});

/* --------------------------------------------------------------------------------- */
/* Get All Inputs Id's Realted to a subcat */
Route::get('subcatsinputs/{id}','API\Admin\SubCategoryAPI@all_subcatsids');

/* Cruds  Routes */
Route::resource('categories','API\Admin\CategoryApi');
Route::resource('subcategories','API\Admin\SubCategoryAPI');
Route::resource('inputs','API\Admin\InputsAPI');
Route::resource('tags','API\Admin\TagsAPI');

/* Filters Routes */
Route::get('filter/categories','API\Admin\CategoryApi@indexWithFilter');
Route::get('filter/tags','API\Admin\TagsAPI@indexWithFilter');
Route::get('filter/inputs','API\Admin\InputsAPI@indexWithFilter');
Route::get('filter/subcategories','API\Admin\SubCategoryAPI@indexWithFilter');

/* Get All Inputs Id's Realted to a subcat && get ALL Inputs Values For this Item */
Route::post('subcatalldata','API\Admin\SubCategoryAPI@all_items_subcats_data');

/* Get All subCAts  Realted to a cat */
Route::get('catsubcats/{id}','API\Admin\CategoryApi@all_subCatsData');

/* Relations ships  Routes */
Route::post('subcategories/inputs','API\Admin\SubCategoryAPI@subcats_inputs');


/* --------------------------------------------------------------------------------- */



Route::get('pola', 'API\Users@getAllUsers');


Route::get('testpola/{q}','API\ItemsFilters@myFilter');

Route::get('filter/items','API\Items@indexWithFilter');

Route::get('email', 'API\EmailController@sendEmail');














//Route::resource('requests','API\ItemsRequests');




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








//Route::post('items/images','API\ImagesController@uploadImages');
