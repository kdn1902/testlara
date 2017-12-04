<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function employees()
    {
        return $this->hasMany('\App\Employee', 'post_id', 'id');
    }
}
