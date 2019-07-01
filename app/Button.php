<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    protected $fillable =['name','user_id'];

    public function device(){
        return $this->belongsTo('App\Device');
    }
}
