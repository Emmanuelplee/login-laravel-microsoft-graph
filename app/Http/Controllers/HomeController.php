<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // MARK:GLOBAL
    function welcome()
    {
        return view('welcome');
    }
}
