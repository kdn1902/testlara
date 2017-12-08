<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getemployees()
    {
        $vuetable = new \App\EloquentVueTables();
        $table_data = $vuetable->get(new \App\Employee, ['id', 'lastname', 'firstname', 'otchestvo', 'birthday']);
        return response()->json($table_data);
	}
	
	public function getdepartments()
    {
    	$t= [
    	     ["id" => 1, "name" => "Дирекция"],
 	 		 ["id" => 2, "name" => "Служба ИТ"],
  	 		 ["id" => 3, "name" => "Служба логистики"],
  	 		 ["id" => 4, "name" => "Юридический отдел"]
  	 		];
        return response()->json($t);
	}
	
	public function getposts()
    {
    	$t= [
    	     ["id" => 1, "name" => "Директор 1"],
 	 		 ["id" => 2, "name" => "Директор 2"],
  	 		 ["id" => 3, "name" => "Директор 3"],
  	 		];
        return response()->json($t);
	}

}
