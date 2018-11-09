<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cummulative extends Model
{
    //

    protected $fillable = [ 'classroom_id', 'session_id', 'user_id', 'total'];
}
