<?php

namespace App\Http\Controllers;

use App\Button;
use App\Device;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IRController extends Controller
{
    public function updateIR($id){


        $button=Button::where('id',$id)->first();

//        $user = User::where('id',Auth::id())->first();
//        $user->current_ir=$button->ir_code;
//        $user->save();
        User::where('id',Auth::id())->update([
            'current_ir'=>"Send_IR\n".$button->ir_code,
        ]);
        sleep(1);
        return redirect('/');
    }
}
