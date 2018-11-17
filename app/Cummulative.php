<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cummulative extends Model
{
    //

    protected $fillable = [ 'classroom_id', 'term_id', 'session_id', 'user_id', 'total','released', 'checked', 'position', 'teacher_remarks'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom', 'classroom_id');
    }

    public function term()
    {
        return $this->belongsTo('App\Term', 'term_id');
    }
}
