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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    // categories
    $router->get('categories', ['uses' => 'CategoriesController@index']);
    $router->get('categories/{id}', ['uses' => 'CategoriesController@show']);
    $router->post('categories', ['uses' => 'CategoriesController@create']);
    $router->put('categories/{id}', ['uses' => 'CategoriesController@update']);
    $router->delete('categories/{id}', ['uses' => 'CategoriesController@delete']);

    // products
    $router->get('products', ['uses' => 'ProductsController@index']);
    $router->get('products/{id}', ['uses' => 'ProductsController@show']);
    $router->post('products', ['uses' => 'ProductsController@create']);
    $router->put('products/{id}', ['uses' => 'ProductsController@update']);
    $router->delete('products/{id}', ['uses' => 'ProductsController@delete']);
});