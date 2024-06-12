<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);
    // Barang Routes
    $router->group(['prefix' => 'barangs'], function () use ($router) {
        $router->get('/', 'BarangController@index');
        $router->get('/{id}', 'BarangController@show');
        $router->post('/', ['middleware' => 'auth', 'uses' => 'BarangController@store']);
        $router->put('/{id}', 'BarangController@update');
        $router->delete('/{id}', 'BarangController@destroy');
    });

    // Peminjaman Routes
    $router->group(['prefix' => 'peminjaman'], function () use ($router) {
        $router->get('/', 'PeminjamanController@index');
        $router->get('/{id}', 'PeminjamanController@show');
        $router->post('/', 'PeminjamanController@store');
        $router->put('/{id}', 'PeminjamanController@update');
        $router->delete('/{id}', 'PeminjamanController@destroy');
    });
});
