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

$router->group(['prefix'=>'api/'], function() use($router) {
    /**
     * Group Routes
     */
    $router->get('group', 'GroupController@index');
    $router->post('group', 'GroupController@store');
    $router->get('group/{id}', 'GroupController@show');
    $router->put('group/{id}', 'GroupController@update');
    $router->delete('group/{id}', 'GroupController@destroy');

    /**
     * Category Routes
     */
    $router->get('category', 'CategoryController@index');
    $router->post('category', 'CategoryController@store');
    $router->get('category/{id}', 'CategoryController@show');
    $router->put('category/{id}', 'CategoryController@update');
    $router->delete('category/{id}', 'CategoryController@destroy');

    /**
     * Sub-Category Routes
     */
    $router->get('sub-category', 'SubCategoryController@index');
    $router->post('sub-category', 'SubCategoryController@store');
    $router->get('sub-category/{id}', 'SubCategoryController@show');
    $router->put('sub-category/{id}', 'SubCategoryController@update');
    $router->delete('sub-category/{id}', 'SubCategoryController@destroy');
});

