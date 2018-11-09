<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //

    protected $fillable = [ 'title', 'codeName', 'schoolCategory'];

    public function classroomsubjects()
    {
        return $this->hasMany('App\Classroomsubject');
    }
}
