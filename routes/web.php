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
    return date('Y-m-d H:i:s');
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', [ 
        'as' => 'auth.register',
        'uses' => 'AuthController@register' 
    ]);
    
    $router->post('/login', [ 
        'as' => 'auth.login',
        'uses' => 'AuthController@login' 
    ]);
    
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/profile', [ 
            'as' => 'auth.profile',
            'uses' => 'AuthController@profile' 
        ]);
    
        $router->get('/logout', [ 
            'as' => 'auth.logout',
            'uses' => 'AuthController@logout' 
        ]);
    });
});

$router->group(['prefix' => 'state', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', [ 
        'as' => 'states.index',
        'uses' => 'StateController@index' 
    ]);

    $router->get('/{id}', [ 
        'as' => 'states.show',
        'uses' => 'StateController@show' 
    ]);
});

$router->group(['prefix' => 'city', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', [ 
        'as' => 'city.index',
        'uses' => 'CityController@index' 
    ]);

    $router->get('/{id}', [ 
        'as' => 'city.index',
        'uses' => 'CityController@show' 
    ]);
});
