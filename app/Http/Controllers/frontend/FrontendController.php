<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //To view frontend page
    public function index(){
        return view('frontend.index');
    }
}
