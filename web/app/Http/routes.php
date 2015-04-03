<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

//Everyone can login

Route::get('users/login', ['as' => 'users.loginform', 'uses' => 'UsersController@loginForm']);
Route::post('users/login', ['as' => 'users.login', 'uses' => 'UsersController@login']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('users/logout', ['as' => 'users.logout', 'uses' => 'UsersController@logout']);

    Route::resource('users', 'UsersController');
    Route::get('users/{id}/delete', ['as' => 'users.delete', 'uses' => 'UsersController@delete']);

    Route::resource('persons', 'PersonsController');
    Route::get('persons/{id}/delete', ['as' => 'persons.delete', 'uses'=>'PersonsController@delete']);
});