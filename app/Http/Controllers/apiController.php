<?php

namespace App\Http\Controllers;
use App\Button;
use App\Device;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apiController extends Controller
{
    public function get($user_name){
        $ir=User::where('name',$user_name)->first()->current_ir;
        $updateTime=User::where('name',$user_name)->first()->updated_at;
        return "$ir\n".$updateTime;
    }

    public function getCode(Request $request,$user_name){//送られてきたIRをcurrent_irに設定
        if($request->input('temperature')!==null){
            User::where('name',$user_name)->update([
                'current_temperature'=>$request->input('temperature')
            ]);
        }
        else{
            if(User::where('name',$user_name)->first()->studying == false){
                return \App::abort(404);
            }
            User::where('name',$user_name)->update([
                'current_ir'=>"Send_IR\n".$request->input('code'),
                'studying'=>0
            ]);
        }
    }
    /*public function getTemparature(Request $request,$user_name){
        
        User::where('name',$user_name)->update([
            'current_temperature'=>$request->input('temperature')
        ]);
    }*/
    public function updateTemparature($user_name){
        return redirect('/')->with([
            'current_temprature'=>User::where('name',$user_name)->first()->current_temparature
        ]);
    }


    //xhr関係
    public function startStudy(){
        User::where('id',Auth::id())->update([
            'current_ir'=>"Learn_IR\n",
            'studying'=>1
        ]);
//        return null;
    }

    public function addButton(Request $request,$device_id){
        $button=new Button();
        $button->name=$request->button_name;
        $button->device_id=$request->device_id;
        $button->ir_code=$request->ir_code;
        $button->save();
    }
}

//“Send_IR”
//IR_code
//timestamp
