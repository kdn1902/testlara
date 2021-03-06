<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class AjaxController extends Controller
{
    /**
	* 
	* 
	* @return
	*/
    public function getemployees()
    {
        $vuetable = new \App\EloquentVueTables();
        $table_data = $vuetable->get(new \App\Employee, ['id', 'lastname', 'firstname', 'otchestvo', 'birthday', 'small_foto']);
        return response()->json($table_data);
	}
	
	/**
	* 
	* 
	* @return
	*/
	public function getdepartments()
    {
        return response()->json(\App\Department::all());
	}
	
	/**
	* 
	* 
	* @return
	*/
	public function getposts()
    {
        return response()->json(\App\Post::all());
	}


    public function setemployee(Request $request) 
    {
	    	$this->validate($request, [
    			'lastname' => 'required|alpha',
    			'firstname' => 'required|alpha',
    			'otchestvo' => 'required|alpha',
    			'phone' => 'required',
    			'address' => 'required',
    			'personal_salary' => 'nullable|digits_between:2,5'
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
      		  	'personal_salary.digits_between' => 'Не верно поле Зарплата'
 			]);
 			
    			$employee = \App\Employee::find($request->id);
    			$employee->lastname = $request->lastname;
    			$employee->firstname = $request->firstname;
    			$employee->otchestvo = $request->otchestvo;
    			$employee->birthday = $request->birthday;
    			$employee->employment_date = $request->employment_date;
    			$employee->department_number = $request->department_number;
    			$employee->post_id = $request->post_id;
    			$employee->birthday = $request->birthday;
    			$employee->phone = $request->phone;
    			$employee->address = $request->address;
 				$employee->personal_salary = $request->personal_salary;	
    			$employee->save();
    		   	return response()->json(["status" => "Данные изменены успешно"]);
	}
	
	public function upload(Request $request, \App\SimpleImage $image)
    {
        	if($request->hasFile('image')) 
        	{
        		$path = $request->file("image")->store('employee_foto', 'public');  
        		$small_path = $request->file("image")->store('employee_foto/small', 'public');  
        		$image->load(storage_path('app/public/' . $path));
        		$image->resizeToWidth(100);
   				$image->save(storage_path('app/public/' . $small_path));
        		$employee = \App\Employee::find($request->id);
        		$employee->foto = $path;
    			$employee->small_foto = $small_path;
    			$employee->save();
    			return response()->json(["foto"=>$path, "small_foto" => $small_path]);
        	}
        	else
        	{
				abort(403, 'Unauthorized action.');
			}
    }
    
    public function dropfoto(Request $request)
    {
				$employee = \App\Employee::find($request->id);
        		$employee->foto = null;
    			$employee->small_foto = null;
    			$employee->save();
    			return response()->json(["foto"=>"", "small_foto" => ""]);
	}
	
}
