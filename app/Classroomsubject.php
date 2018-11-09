<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroomsubject extends Model
{
    //
    protected $fillable = [ 'classroom_id', 'subject_id'];

    public function subject()
{
    return $this->belongsTo('App\Subject', 'subject_id');
}

public function classroom()
{
    return $this->belongsTo('App\Classroom', 'classroom_id');
}
}
