<?php

namespace App\Http\Controllers;

use App\Button;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditButtonController extends Controller
{
    public function index($id)
    {
        return view('editbtn')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'buttons'=>Button::where('device_id',Device::where('user_id',Auth::id())->get()),
            'status'=>null,
            'button_id'=>$id
        ]);
    }

    public function deleteButton(){
//        Button::destroy($id);
        return redirect('/')->with('status', 'ボタンを削除しました');
    }

    public function editButton(Request $request,$id){
        Button::where('id',$id)->first()->update([
            'name'=>$request->new_name,
            'ir_code'=>'編集後のIRコード'
            ]);
        return redirect('/')->with('status', 'ボタンを編集しました');
    }


}
