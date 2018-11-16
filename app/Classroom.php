<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //

    protected $fillable = [ 'name', 'alias', 'schoolCategory'];
    public function classroomsubjects()
    {
        return $this->hasMany('App\Classroomsubject');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }


    public function result()
    {
        return $this->hasMany('App\Result');
    }

    public function cummulative()
    {
        return $this->hasMany('App\Cummulative');
    }

    public function releasenote()
    {
        return $this->hasMany('App\Releasenote');
    }
}
