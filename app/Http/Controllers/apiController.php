<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function get(Request $request){
        if ($request->user&&$request->device&&$request->button){
            $output=[
                "message"=>"true query",
            ];
        }else{
            $output=[
                "message"=>"bad query",
            ];
        }

        return $output;
    }
}
