<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function get($user_name){
        return $user_name;
    }
}
