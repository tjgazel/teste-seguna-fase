<?php

/**
 * @var $router \Laravel\Lumen\Routing\Router
 */

$router->get('/', function () use ($router) {
    return response()->json($router->app->version());
});


$router->group(
    ['namespace' => 'V1', 'prefix' => 'v1/auth'],
    function (\Laravel\Lumen\Routing\Router $router) {

        $router->post('login', 'AuthController@login');
        $router->post('refresh', 'AuthController@refresh');

    }
);

$router->group(
    ['namespace' => 'V1', 'prefix' => 'v1', 'middleware' => 'auth'],
    function (\Laravel\Lumen\Routing\Router $router) {

        $router->post('auth/logout', 'AuthController@logout');
        $router->post('auth/me', 'AuthController@me');

        $router->get('finalidades', 'FinalidadesController@index');

        $router->get('predios', 'PrediosController@index');
        $router->post('predios', 'PrediosController@store');
        $router->get('predios/{id}', 'PrediosController@show');
        $router->put('predios/{id}', 'PrediosController@update');
        $router->delete('predios/{id}', 'PrediosController@destroy');

        $router->post('apartamentos', 'ApartamentosController@store');
        $router->get('apartamentos/{id}', 'ApartamentosController@show');
        $router->put('apartamentos/{id}', 'ApartamentosController@update');
        $router->delete('apartamentos/{id}', 'ApartamentosController@destroy');

    }
);
