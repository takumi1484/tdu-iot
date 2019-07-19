<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function get($user_name){
        $ir=User::where('name',$user_name)->first()->current_ir;
        return $ir;
    }

}
