<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dcblogdev\MsGraph\Facades\MsGraph;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function connect()
    {
        return MsGraph::connect();
    }

    public function logout()
    {
        return MsGraph::disconnect();
    }
}
