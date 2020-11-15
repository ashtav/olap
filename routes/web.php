<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

$router->post('/login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () use ($router) {

    $router->get('/dashboard', 'HomeController@index');
    $router->get('/logout', 'AuthController@logout');

    $router->group(['prefix' => 'data-center'], function () use ($router) {
        $router->get('/', 'DataCenterController@index');
        $router->post('/', 'DataCenterController@store');
        $router->delete('/{tahun}', 'DataCenterController@destroy');
    });

    $router->group(['prefix' => 'data-mart'], function () use ($router) {
        $router->get('/', 'DataMartController@index');
        $router->get('/chart', 'DataMartController@chart');
        $router->post('/chart', 'DataMartController@createChart');
    });

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->post('/', 'UserController@store');
        $router->put('/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@destroy');
    });

    $router->group(['prefix' => 'akun'], function () use ($router) {
        $router->get('/', 'AuthController@index');
        $router->put('/{id}', 'AuthController@update');
        $router->post('/update-akun', 'AuthController@updateAccount');
        $router->post('/update-foto', 'AuthController@changeAvatar');
    });



});

