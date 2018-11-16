<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //

    protected $fillable = [ 'name', 'start', 'end', 'status'];

    public function cummulative()
    {
        return $this->hasMany('App\Cummulative');
    }

    public function releasenote()
    {
        return $this->hasMany('App\Releasenote');
    }

    public function result()
    {
        return $this->hasMany('App\Result');
    }
}
