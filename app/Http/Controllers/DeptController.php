<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           return response()->json(['depts' => Department::get_departments()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $this->validate($request, [
            	'name'        => 'required|alpha_spaces',
            	'parent_number' => 'required|numeric'
        	],
         	[
         	    'name.required' => 'Название не введено',
      		  	'name.alpha_spaces' => 'Название введено не верно',
      		  	'parent_number.required' => 'Родительский отдел не введен',
      		  	'parent_number.numeric' => 'Родительский отдел введен не верно'
        	]);
 
        $dept = Department::create([
            'name' => $request->name,
            'department_parent' => $request->parent_number,
            'department_number' => 9999999
        ]);
        $dept->department_number = $dept->id;
        $dept->save;
        
        return response()->json(['depts' => Department::get_departments()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Department $dept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $dept)
    {
    	    $this->validate($request, [
            	'name'        => 'required|alpha_spaces'
        	],
         	[
         	    'name.required' => 'Название не введено',
      		  	'name.alpha_spaces' => 'Название введено не верно'
        	]);
        	$dept->name = $request->name;
        	$dept->department_parent = $request->parent_number;
			$dept->save();
        	return response()->json(['depts' => Department::get_departments()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department $dept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $dept)
    {
        //
        if( count(Department::find($dept->id)->employees) > 0 )
    	{	
			return response()->json(['errors' => ['message' =>'Есть сотрудники в этом отделе']])->setStatusCode(422);
		}
		//$dept->delete();
    }
}
