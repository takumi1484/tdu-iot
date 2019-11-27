<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Macro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Device;
use App\Button;
use Illuminate\Support\Facades\Facade;

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
        User::find(Auth::id())->update([
            'studying'=>0
        ]);
        /*$devices = Device::where('user_id',Auth::id())->get();
        foreach($devices as $device){
            $buttons = Button::where('device_id',$device->id);
            foreach($buttons as $key => $value) {
                $id[$key] = $value['sort_no'];
            }
            array_multisort($id, SORT_ASC, $buttons);
            $device["buttons"] = $buttons;
            array_push($sorted_device,$device);
        }*/
        return view('home')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'macros'=>Macro::where('user_id',Auth::id())->get(),
            'status'=>null
        ]);
    }
    public function study($id){//
        return view('study')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'buttons'=>Button::where('device_id',$id),
            'status'=>null,
            'device_id'=>$id
        ]);
    }
    public function edit($id){
        $user=Auth::user();
        $user_id=$user->id;
        $query=Button::where('device_id',Device::where('user_id',$user_id)->get()->where('id',$id)->first());
        if($query !=NULL) {
            return view('editbtn')->with([
                'devices' => Device::where('user_id', Auth::id())->get(),
                'buttons' => Button::where('device_id', Device::where('user_id', Auth::id())->get()),
                'status' => null,
                'button_id' => $id
            ]);
        }return redirect('/');
    }

    public function addDevice(Request $request){
        $devices=new Device;
        $devices->name=$request->device_name;
        $devices->user_id=Auth::id();
        $devices->manufacturer=$request->manufacturer;
        $devices->product=$request->product;
        $devices->shared=true;
        $devices->copied=false;
        $devices->save();
        return redirect('/')->with('status', '区分を追加しました');
    }

    public function copyDevice(Request $request){
        $user_id = Auth::id();
        $id = $request->input('id');
        $device = Device::find($id)->replicate();
        $device->user_id = $user_id;
        $device->shared = False;
        $device->copied = True;
        $device->save();

        $buttons = Button::where('device_id',$id);
        if ($buttons->exists()) {
            foreach ($buttons->get() as $button) {
                $new_button = $button->replicate();
                $new_button->device_id = $device->id;
                $new_button->save();
            }
        }

        return redirect('/')->with('status', 'コピーしました');
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


//    public function editButton(Request $request,$id){
//        Button::where('id',$id)->get()->update([
//            'name'=>'編集後の名前',
//            'ir_code'=>'編集後のIRコード'
//            ]);
//        return redirect('/')->with('status', 'ボタンを編集しました');
//    }

//    public function deleteButton($id){
//        Button::destroy($id);
//        return redirect('/')->with('status', 'ボタンを削除しました');
//    }

//    public function test(Request $request){
//        return view('study')->with([
//           'message'=>$request
//        ]);
//    }
}
