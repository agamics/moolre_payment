<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Index
    public function index()
    {
        return view('frontend');
    }
}
