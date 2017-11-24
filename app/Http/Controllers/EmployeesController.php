<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //
    public function index($pid = 0)
    {
		return view('index.employees');
	}
}
