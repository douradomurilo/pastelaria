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
    
    /** Clients */
    $router->get('clients', 'ClientsController@index');
    $router->get('clients/{id}', 'ClientsController@show');
    $router->post('clients', 'ClientsController@create');
    $router->put('clients/{id}', 'ClientsController@update');
    $router->delete('clients/{id}', 'ClientsController@destroy');

    /** Products */
    $router->get('products', 'ProductsController@index');
    $router->get('products/{id}', 'ProductsController@show');
    $router->post('products', 'ProductsController@create');
    $router->put('products/{id}', 'ProductsController@update');
    $router->delete('products/{id}', 'ProductsController@destroy');

    /** Orders */
    $router->get('orders', 'OrdersController@index');
    $router->get('orders/{id}', 'OrdersController@show');
    $router->post('orders', 'OrdersController@create');
    $router->put('orders/{id}', 'OrdersController@update');
    $router->delete('orders/{id}', 'OrdersController@destroy');

    $router->post('orders/{id}/add-product', 'OrdersController@addProduct');
    $router->post('orders/{id}/remove-product', 'OrdersController@removeProduct');
    $router->post('orders/{id}/send-mail', 'OrdersController@sendMail');

});