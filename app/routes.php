<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 
	array(
		'as'=>'home',
		'uses'=>'HomeController@home'


		));
/*
Unauthenticated Group
|
|
*/

Route::group(array('before'=>'guest'),function(){
/*
protection group
|
|
*/
Route::group(array('before'=>'csrf'),function(){

/*
create account post
|
|
*/
Route::post('/account/create', 
	array(
		'as'=>'account-create-post',
		'uses'=>'AccountController@postCreate'


		));
});
/*
Create account get
|
|
*/
Route::get('/account/create', 
	array(
		'as'=>'account-create',
		'uses'=>'AccountController@getCreate'


		)); 
Route::get('/account/activate/{code}', 
	array(
		'as'=>'account-activate',
		'uses'=>'AccountController@getactivate'


		));


/*
create signin post
|
|
*/
Route::post('/account/signin', 
	array(
		'as'=>'account-sign-in-post',
		'uses'=>'AccountController@postSignIn'


		));

/*
Create signin get
|
|
*/
Route::get('/account/signin', 
	array(
		'as'=>'account-sign-in',
		'uses'=>'AccountController@getSignIn'


		)); 

});

