<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function get($user_name){
        $ir=User::where('name',$user_name)->first()->current_ir;
        return "Send_IR\n$ir\n".date("Y-m-d H:i:s");
    }
}

//“Send_IR”
//IR_code
//timestamp
