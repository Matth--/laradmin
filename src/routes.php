<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix' => config('laradmin.prefix'), 'as' => 'laradmin.'], function () {
        Route::group(['middleware' => ['auth']], function() {
            Route::get('/', function() {
                return redirect()->route('laradmin.welcome');
            });
            Route::get('index', [
                'as' => 'welcome',
                'uses' => '\MatthC\Laradmin\Http\Controllers\WelcomeController@index'
            ]);
        });

        Route::get('login', '\MatthC\Laradmin\Http\Controllers\AuthController@getLogin');

        Route::post('login', '\MatthC\Laradmin\Http\Controllers\AuthController@postLogin');

        Route::get('logout', '\MatthC\Laradmin\Http\Controllers\AuthController@logout');

        if(config('laradmin.can_register')) {
            Route::get('register', '\MatthC\Laradmin\Http\Controllers\AuthController@getRegister');

            Route::post('register', '\MatthC\Laradmin\Http\Controllers\AuthController@postRegister');
        }

        Route::group(['as' => 'users.', 'prefix' => 'users', 'middleware' => ['role:admin']], function() {
            Route::get('/', [
                'as' => 'index',
                'uses'=> '\MatthC\Laradmin\Http\Controllers\UsersController@index',
            ]);

            Route::get('create', [
                'as' => 'create',
                'uses' => '\MatthC\Laradmin\Http\Controllers\UsersController@getCreate'
            ]);

            Route::post('create', [
                'as' => 'create',
                'uses' => '\MatthC\Laradmin\Http\Controllers\UsersController@postCreate'
            ]);

            Route::get('edit/{id}', [
                'as' => 'edit',
                'uses' => '\MatthC\Laradmin\Http\Controllers\UsersController@getEdit'
            ]);

            Route::post('edit/{id}', [
                'as' => 'edit',
                'uses' => '\MatthC\Laradmin\Http\Controllers\UsersController@postEdit'
            ]);

            Route::post('edit/{id}/roles', [
                'as' => 'updateroles',
                'uses' => '\MatthC\Laradmin\Http\Controllers\UsersController@updateRoles'
            ]);

            Route::get('delete/{id}', [
                'as' => 'delete',
                'uses' => '\MatthC\Laradmin\Http\Controllers\UsersController@delete'
            ]);
        });
    });
});