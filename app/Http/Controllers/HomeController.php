<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Device;
use App\Button;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'buttons'=>Button::where('device_id',Device::where('user_id',Auth::id())->get()),
            'status'=>null
            //不安
        ]);
    }
    public function study($id){
        return view('study')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'buttons'=>Button::where('device_id',Device::where('user_id',Auth::id())->get()),
            'status'=>null,
            'device_id'=>$id
            //不安
        ]);
    }
    public function edit($id){
        return view('editbtn')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'buttons'=>Button::where('device_id',Device::where('user_id',Auth::id())->get()),
            'status'=>null,
            'button_id'=>$id
        ]);
    }

    public function addDevice(Request $request){
        $devices=new Device;
        $devices->name=$request->device_name;
        $devices->user_id=Auth::id();
        $devices->save();
        return redirect('/')->with('status', '区分を追加しました');
    }

    public function deleteDevice($id){
        Device::destroy($id);
        Button::where('device_id',$id)->delete();
        return redirect('/')->with('status', '区分を削除しました');
    }
    public function addButton(Request $request){
        $button=new Button();
        $button->name=$request->button_name;
        $button->device_id=$request->device_id;
        $button->ir_code="IRコード格納予定";
        $button->save();
        return redirect('/')->with('status', 'ボタンを追加しました');
    }

    public function editButton(Request $request,$id){
        Button::where('id',$id)->get()->update([
            'name'=>'編集後の名前',
            'ir_code'=>'編集後のIRコード'
            ]);
        return redirect('/')->with('status', 'ボタンを編集しました');
    }

    public function deleteButton($id){
        Button::destroy($id);
        return redirect('/')->with('status', 'ボタンを削除しました');
    }
}
