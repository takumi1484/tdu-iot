<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Macro extends Model
{
    public function macroRelation(){
        return $this->hasMany('App\MacroRelation');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
