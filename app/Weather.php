<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = [
        'weather','weather_description','weather_icon','temp','temp_max','temp_min','humidity','wind_speed','pressure'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function weather(){
        return $this->hasMany('App\Weather');
    }
}
