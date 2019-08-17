<?php

namespace App\Http\Controllers;


use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditDeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        return view('editkbn')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'status'=>null,
            'device_id'=>$id,
            'device_name'=>Device::where('user_id',Auth::id())->where('id',$id)->value('name'),
            'device_manufacturer'=>Device::where('user_id',Auth::id())->where('id',$id)->value('manufacturer'),
            'device_product'=>Device::where('user_id',Auth::id())->where('id',$id)->value('product')
        ]);
    }
    public function sharebutton(){
        return redirect('/');
    }

    
    public function editDevice(Request $request,$id){
        Device::where('id',$id)->first()->update([
            'name'=>$request->new_name,
            'product'=>$request->new_product,
            'manufucture'=>$request->new_manufacture,
            ]);
        return redirect('/')->with('status', '区分を編集しました');
    }


}
