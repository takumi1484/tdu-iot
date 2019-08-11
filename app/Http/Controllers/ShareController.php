<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Device;
use App\Button;

class shareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchData(Request $request)
    {
        $devices = Device::where('shared',true)
        ->where('manufacturer',$request->input('manufacturer'));
        if($request->input('product')) {
            $devices->where('product', $request->input('product'));
        }
        if($request->input('device_name')) {
            $devices->where('name', $request->input('device_name'));
        }
        /*if(!$devices->first()){return redirect('/');}*/
        $devices = $devices->get();
        return view('searchResults',compact('devices'));

    }

}