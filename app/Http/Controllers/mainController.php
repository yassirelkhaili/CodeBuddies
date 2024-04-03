<?php

namespace App\Http\Controllers;

class mainController extends Controller
{   
    public function indexHome() {
        return view('home');
    }
}
