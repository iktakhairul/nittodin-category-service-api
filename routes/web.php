<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/home', function (){
    return "welcome";
});

/**
 * Group Routes
 */
$router->get('groups', 'GroupController@index');
$router->post('group', 'GroupController@store');
$router->get('group/{id}', 'GroupController@show');
$router->put('group/{id}', 'GroupController@update');
$router->delete('group/{id}', 'GroupController@destroy');

/**
 * Category Routes
 */
$router->get('categories', 'CategoryController@index');
$router->get('category/create', 'CategoryController@create');
$router->post('category/store', 'CategoryController@store');
$router->get('category/show/{id}', 'CategoryController@show');
$router->get('category/edit/{id}', 'CategoryController@edit');
$router->post('category/update/{id}', 'CategoryController@update');
$router->get('category/destroy/{id}', 'CategoryController@destroy');
$router->get('category/update-status/{id}', 'CategoryController@update_status');


/**
 * Sub-Category Routes
 */
$router->get('sub-categories', 'SubCategoryController@index');
$router->post('sub-category', 'SubCategoryController@store');
$router->get('sub-category/{id}', 'SubCategoryController@show');
$router->put('sub-category/{id}', 'SubCategoryController@update');
$router->delete('sub-category/{id}', 'SubCategoryController@destroy');
