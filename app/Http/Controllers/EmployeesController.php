<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeesController extends Controller
{
    //
    public function index()
    {
		return view('index.employees');
	}

    public function getemployee($id) 
    {
    	$empl = Employee::find($id);
    	$post = Employee::find($id)->post;
    	$empl["post_name"] = $post->name;
    	$empl["post_id"] = $post->id;
    	$depart = Employee::find($id)->department;
    	$empl["department_name"] = $depart->name;
    	$empl["department_id"] = $depart->id;
		return view('index.employee',[ "empl" => $empl ]);
	}

}
