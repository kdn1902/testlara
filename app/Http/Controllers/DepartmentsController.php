<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index()
    {
		return view('index.departments');
	}
}
