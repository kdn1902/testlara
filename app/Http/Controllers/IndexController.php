<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
   
    public function index($pid = 0)
    {
		return view('index.app');
	}
}
