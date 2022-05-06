<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboradController extends Controller
{
    public function index(){
        // return view('dashboard');
        $roles=Auth::user()->roles;

        if ($roles == 'ADMIN') {
            return view('dashboard');
        } else if ($roles == "USER"){
            return view('dashboard');
        }

    }
}
