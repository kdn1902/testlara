<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
	* 
	* @param undefined $pid
	* 
	* @return
	*/
    public function index($pid = 0)
    {
		return view('index.app');
	}
}
