<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //

    protected $fillable = ['test', 'exam', 'user_id', 'classroom_id', 'classroomsubject_id', 'term_id', 'released'];

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }
}

