<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function get($user_name){
        $ir=User::where('name',$user_name)->first()->current_ir;
        $updateTime=User::where('name',$user_name)->first()->updated_at;
        return "Send_IR\n$ir\n".$updateTime;
    }
}

//“Send_IR”
//IR_code
//timestamp
