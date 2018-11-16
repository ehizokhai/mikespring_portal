<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Releasenote extends Model
{
    //

    protected $fillable = [ 'classroom_id', 'term_id', 'session_id', 'released'];
    
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
