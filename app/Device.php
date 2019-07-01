<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name','device_id','ir_code'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function button(){
        return $this->hasMany('App\Button');
    }
}
