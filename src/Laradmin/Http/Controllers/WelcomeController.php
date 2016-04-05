<?php

namespace MatthC\Laradmin\Http\Controllers;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('laradmin::welcome');
    }

    public function root()
    {
        return redirect()->route('laradmin.welcome');
    }
}