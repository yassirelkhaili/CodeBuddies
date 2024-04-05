<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class mainController extends Controller
{   
    public function indexHome(): View
    {
        return view('home');
    }
}
