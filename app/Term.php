<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    //
    protected $fillable = [ 'name', 'start', 'end'];
    public function cummulative()
    {
        return $this->hasMany('App\Cummulative');
    }

    public function releasenote()
    {
        return $this->hasMany('App\Releasenote');
    }
}
