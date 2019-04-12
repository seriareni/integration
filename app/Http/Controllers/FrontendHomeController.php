<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{
    public function index()
    {
        return view ('frontend.home');
    }
    public function showingmap()
    {
        return view ('frontend.map');
    }
}
