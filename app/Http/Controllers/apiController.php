<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function get($user_name){
        return User::where('name',$user_name)->first()->current_ir;
    }
}
