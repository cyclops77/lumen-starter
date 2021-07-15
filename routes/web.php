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
use App\Http\Middleware\AppAuth;
use App\Http\Middleware\RendererAuthValidate;

$router->group(['middleware' => AppAuth::class], function()use ($router){


	$router->group(['prefix'=>'api/v1','namespace'=>'v1'], function()use ($router){

		$router->group(['prefix'=>'auth'], function()use ($router){
	
			$router->post('/login','AuthController@login');
	
			$router->post('/logout','AuthController@logout');
	
			$router->post('/check-auth','AuthController@checkAuth');
	
			$router->post('/buat-akun','AuthController@buatAkun');
	
		});		
	
	$router->group(['middleware' => RendererAuthValidate::class], function()use ($router){

		$router->group(['prefix'=>'users'], function()use ($router){
	
			$router->get('/','UserController@getSemuaUser');
	
		});

	});

});

});
