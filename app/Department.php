<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $fillable = ['name','department_parent', 'department_number'];
	
    public function employees()
    {
        return $this->hasMany('\App\Employee', 'department_number', 'department_number');
    }
    
    static public function get_departments()
    {
	    return 	DB::table('departments as dept1')
    	        ->leftJoin('departments as dept2', 'dept1.department_parent', '=', 'dept2.department_number')
        	    ->select('dept1.id','dept1.name','dept1.department_number', 'dept1.department_parent as department_parent_number', 'dept2.name as department_parent_name')->get();
	}
}
