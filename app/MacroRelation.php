<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MacroRelation extends Model
{
    public function button(){
        return $this->belongsTo('App\Button');
    }
    public function macro(){
        return $this->belongsTo('App\Macro');
    }
}
