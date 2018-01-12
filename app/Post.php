<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $fillable = ['name','salary','post_priority'];
    
    public function employees()
    {
        return $this->hasMany('\App\Employee', 'post_id', 'id');
    }
}
