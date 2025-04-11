<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Group the gateway routes and protect them with the new 'gateway.auth' middleware.
$router->group(['middleware' => 'gateway.auth'], function () use ($router) {
    // API GATEWAY ROUTES FOR SITE1 USERS
    $router->get('/users1', 'User1Controller@index');
    $router->post('/users1', 'User1Controller@add');
    $router->get('/users1/{id}', 'User1Controller@show');
    $router->put('/users1/{id}', 'User1Controller@update');
    $router->patch('/users1/{id}', 'User1Controller@update');
    $router->delete('/users1/{id}', 'User1Controller@delete');

    // API GATEWAY ROUTES FOR SITE2 USERS
    $router->get('/users2', 'User2Controller@index');
    $router->post('/users2', 'User2Controller@add');
    $router->get('/users2/{id}', 'User2Controller@show');
    $router->put('/users2/{id}', 'User2Controller@update');
    $router->patch('/users2/{id}', 'User2Controller@update');
    $router->delete('/users2/{id}', 'User2Controller@delete');
});

// Other routes (if needed) that use a different auth middleware.
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/users/me', 'UserController@me');
});