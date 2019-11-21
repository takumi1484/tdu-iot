<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function weather(){
        return $this->hasMany('App\Weather');
    }
}
