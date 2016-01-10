<?php

namespace MatthC\Laradmin\Http\Controllers;

use App\Models\User;
use MatthC\Privileges\Models\Role;

class AuthController extends \App\Http\Controllers\Auth\AuthController
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->redirectTo = config('laradmin.prefix');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('laradmin::auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('laradmin::auth.register');
    }

    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $role = Role::where('name', config('laradmin.register_user_role'))->first();

        if($role) {
            $user->roles()->attach($role->id);
        }

        return $user;
    }
}