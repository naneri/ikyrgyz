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

Route::get('/', 'AuthController@getLogin');

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('register', 'AuthController@getRegister');
Route::post('register', 'AuthController@postRegister');


Route::group(array('before' => 'auth'),function(){
	Route::get('main/index','MainController@index');
	Route::get('blog/create', 'BlogController@create');
	Route::post('blog/store', 'BlogController@store');
	Route::get('blog/all','BlogController@getAll');
	Route::get('profile/{id}', 'ProfileController@getShow')->where('id', '[0-9]+');
	Route::get('profile/edit', 'ProfileController@getEdit');
	Route::post('profile/edit', 'ProfileController@postEdit');
	Route::get('profile/friends', 'ProfileController@friends');
    Route::get('topic/show/{id}.html', 'TopicController@show');
	Route::get('topic/create', 'TopicController@create');
        Route::post('topic/update', 'TopicController@update');
        Route::post('topic/store', 'TopicController@store');
        Route::post('upload', array('uses' => 'TopicController@uploadImage'));
        Route::get('people', 'PeopleController@index');
        Route::get('people/friendRequest/{id}', 'PeopleController@requestFriend');
	Route::get('logout', 'AuthController@logout');
        Route::resource('tags', 'TagsController');
        Route::get('people/submitFriend/{id}', 'PeopleController@submitFriend');
        Route::resource('photos', 'PhotosController');
