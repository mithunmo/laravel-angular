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


Route::get('/', function () {
    return view('home');
});

//Route::get("/show", "IndexController@show");
//Route::get("/login", "IndexController@login");
//Route::get("/signup", "IndexController@signup");


//Route::get("/products", "IndexController@products");



    Route::get("/products", "ProductController@products");
    Route::get("/products/create", "ProductController@create");
    Route::get("/products/{id}", "ProductController@show");
    Route::post("/products/{id}", "ProductController@update");
    Route::post("/products", "ProductController@store");
    Route::auth();

    Route::get("/users", "UserController@users");
    Route::get("/users/create", "UserController@create");
    Route::get("/users/{id}", "UserController@show");
    Route::post("/users/{id}", "UserController@update");
    Route::post("/users", "UserController@store");


    Route::get('/home', 'HomeController@index');
    Route::get('/items', 'ItemController@index');
    Route::get('/items/{id}', 'ItemController@show');    
    Route::post('/signup', 'Auth\AuthController@signup');
    Route::post('/profile', 'Auth\AuthController@loginapi');


