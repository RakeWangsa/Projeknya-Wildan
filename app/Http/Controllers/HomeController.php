<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home', [
            'title' => 'Home',
            'active' => 'home',
        ]);
    }

    public function sewa()
    {
        return view('user.sewa', [
            'title' => 'Buat Pesanan',
            'active' => 'pesanan',
        ]);
    }
}
