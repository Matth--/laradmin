<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix' => config('laradmin.prefix'), 'as' => 'laradmin.'], function () {
        Route::group(['middleware' => ['auth']], function() {
            Route::get('/', [
                'as' => 'redirect',
                'uses' => '\MatthC\Laradmin\Http\Controllers\WelcomeController@root'
            ]);
            Route::get('index', [
                'as' => 'welcome',
                'uses' => '\MatthC\Laradmin\Http\Controllers\WelcomeController@index'
            ]);
        });

        Route::get('login', '\MatthC\Laradmin\Http\Controllers\AuthController@getLogin');

        Route::post('login', [
            'as'    => 'login',
            'uses'  => '\MatthC\Laradmin\Http\Controllers\AuthController@postLogin',
        ]);

        Route::get('logout', [
            'as'    => 'logout',
            'uses'  => '\MatthC\Laradmin\Http\Controllers\AuthController@logout'
        ]);

        if(config('laradmin.can_register')) {
            Route::get('register', [
                'as' => 'getRegister',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\AuthController@getRegister'
            ]);

            Route::post('register', [
                'as'    => 'postRegister',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\AuthController@postRegister'
            ]);
        }

        Route::group(['as' => 'users.', 'prefix' => 'users', 'middleware' => ['permission:manage_users']], function() {
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

        Route::group(['as' => 'roles.', 'prefix' => 'roles', 'middleware' => ['permission:manage_roles']], function() {
            Route::get('/', [
                'as'    => 'index',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\RolesController@index',
            ]);

            Route::get('create', [
                'as'    => 'create',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\RolesController@create',
            ]);

            Route::post('create', [
                'as'    => 'store',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\RolesController@store',
            ]);

            Route::get('edit/{id}', [
                'as'    => 'edit',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\RolesController@edit',
            ]);

            Route::post('edit/{id}', [
                'as'    => 'update',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\RolesController@update',
            ]);

            Route::get('delete/{id}', [
                'as'    => 'delete',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\RolesController@delete',
            ]);
        });

        Route::group(['as' => 'permissions.', 'prefix' => 'permissions', 'middleware' => ['permission:manage_permissions']], function() {
            Route::get('/', [
                'as' => 'index',
                'uses' => '\MatthC\Laradmin\Http\Controllers\PermissionsController@index',
            ]);

            Route::get('create', [
                'as'    => 'create',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\PermissionsController@create',
            ]);

            Route::post('create', [
                'as'    => 'store',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\PermissionsController@store',
            ]);

            Route::get('edit/{id}', [
                'as'    => 'edit',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\PermissionsController@edit',
            ]);

            Route::post('edit/{id}', [
                'as'    => 'update',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\PermissionsController@update',
            ]);

            Route::get('delete/{id}', [
                'as'    => 'delete',
                'uses'  => '\MatthC\Laradmin\Http\Controllers\PermissionsController@delete',
            ]);
        });
    });
});