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

	public function newemployee()
	{
		return view('index.newemployee');
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
    	$empl["status"] = null;
    	if ($empl["personal_salary"] == null )
    	{
			$empl["personal_salary"] = $post->salary;
			$empl["picked_salary"] = "stat_salary";
		}
		else
		{
			$empl["picked_salary"] = "pers_salary";
		}
		return view('index.employee',[ "empl" => $empl ]);
	}

}
