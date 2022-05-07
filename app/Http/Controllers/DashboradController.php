<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class DashboradController extends Controller
{
    public function index(){
        $roles = Auth::user()->roles;

        $store = auth()->user()->store;

        if ($roles == 'ADMIN') {
            return view('dashboard');
        } else if($roles == 'USER') {
            if ($store == null) {
                return view('market.notRegistrasion');
            } else {
                return view('dashboard');
            }
        }
    }
}
