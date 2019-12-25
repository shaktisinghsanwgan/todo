<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function sub_tasks(){
        return $this->hasMany('App\Sub_task','task_id');
    }
}
