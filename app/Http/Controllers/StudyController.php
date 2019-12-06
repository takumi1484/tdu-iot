<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class StudyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function studyIR(Request $request){
        return redirect('/');
        $pre_ir = Auth::user()->recv_ir;
        User::where('id',Auth::id())->update([
            'current_ir'=>"Learn_IR\n",
            'studying'=>1
        ]);
        $limit = 0;
//        while($pre_ir != Auth::user()->recv_ir) {
//            sleep(1);
//            $limit++;
//            if($limit > 30){
//                return redirect();
//            }
//        }
        #ここにボタンを作成させる処理または関数を実行させる
        $button=new Button();
        $button->name=$request->button_name;
        $button->device_id=$request->device_id;
        $button->ir_code=Auth::user()->recv_ir;
        $button->save();
//        return redirect('/');
    }
}
