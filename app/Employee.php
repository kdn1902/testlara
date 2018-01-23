<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = ["lastname","firstname","otchestvo","birthday","employment_date","department_number",
    			"post_id","birthday","phone","address","personal_salary"];
    
    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
    
    public function department()
    {
        return $this->belongsTo('App\Department','department_number','department_number');
    }
}
