<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    //
    protected $fillable = [ 'pin', 'cummulative_id', 'user_id', 'used'];
}
