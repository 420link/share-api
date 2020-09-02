<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('/shares', 'SharesController');
Route::post('/register', 'RegisterController@post');
Route::post('/login', 'LoginController@post');
Route::post('/logout', 'LogoutController@post');
Route::get('/user', 'UsersController@get');
Route::put('/user', 'UsersController@put');
Route::post('/like', 'LikesController@post');
Route::delete('/like', 'LikesController@delete');
Route::post('/comment', 'CommentsController@post');