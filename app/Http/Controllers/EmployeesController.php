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
	
	public function addemployee(Request $request, \App\SimpleImage $image)
	{
			$this->validate($request, [
    			'lastname' => 'required|alpha',
    			'firstname' => 'required|alpha',
    			'otchestvo' => 'required|alpha',
    			'phone' => 'required',
    			'address' => 'required',
    			'salary' => 'nullable|digits_between:2,5',
    			'image' => 'nullable|mimes:jpeg,bmp,png',
    			'curr_post' => 'required|integer',
    			'curr_depart' => 'required|integer'
			],
			[
      		  	'lastname.required' => 'Фамилия не введена',
      		  	'lastname.alpha' => 'Фамилия введена не верно',
      		  	'firstname.required' => 'Имя не введено',
      		  	'firstname.alpha' => 'Имя введено не верно',
      		  	'otchestvo.required' => 'Отчество не введено',
      		  	'otchestvo.alpha' => 'Отчество введено не верно',
      		  	'phone.required' => 'Номер телефона не введен',
      		  	'address.required' => 'Адрес не введен',
      		  	'salary.digits_between' => 'Не верно поле Зарплата',
      		  	'image.mimes:jpeg,bmp,png' => 'Фотография должна быть в графическом формате',
      		  	'curr_depart.required' => 'Департамент не введен',
      		  	'curr_depart.integer' => 'Департамент введен не верно',
      		  	'curr_post.required' => 'Должность не введена',
      		  	'curr_post.integer' => 'Должность введена не верно'
 			]);
 			$salary = null;
 			if( !empty($request->pers_salary) &&  !empty($request->salary ))
 			{
				$salary = $request->salary;
			}
 			$employee = \App\Employee::create([
 			    "lastname" => $request->lastname,
    			"firstname" => $request->firstname,
    			"otchestvo" => $request->otchestvo,
    			"birthday" => $request->birthday,
    			"employment_date" => $request->employment_date,
    			"department_number" => $request->curr_depart,
    			"post_id" => $request->curr_post,
    			"birthday" => $request->birthday,
    			"phone" => $request->phone,
    			"address" => $request->address,
 				"personal_salary" => $salary
				]);
			if($request->hasFile('image')) 
        	{
        		$path = $request->file("image")->store('employee_foto', 'public');  
        		$small_path = $request->file("image")->store('employee_foto/small', 'public');  
        		$image->load(storage_path('app/public/' . $path));
        		$image->resizeToWidth(100);
   				$image->save(storage_path('app/public/' . $small_path));
        		$employee->foto = $path;
    			$employee->small_foto = $small_path;
    			$employee->save();
    		}
		return view('index.newemployee', ["status" => "Сотрудник создан успешно"]);
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
