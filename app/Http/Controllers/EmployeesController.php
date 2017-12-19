<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeesController extends Controller
{
/**
* 
* 
* @return
*/
    public function index()
    {
		return view('index.employees');
	}

/**
* 
* @param undefined $id
* 
* @return
*/
    public function getemployee($id) 
    {
    	$empl = Employee::find($id);
    	$post = Employee::find($id)->post;
    	$empl["post_name"] = $post->name;
    	$empl["post_id"] = $post->id;
    	$depart = Employee::find($id)->department;
    	$empl["department_name"] = $depart->name;
    	$empl["department_number"] = $depart->department_number;
    	$empl["status"] = "";
		return view('index.employee',[ "empl" => $empl ]);
	}

}