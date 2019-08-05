<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shareController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchData(Request $request)
    {
        $device = Device::where('manufacturer',$request->input('manufacturer'));
        if($request->input('product')) {
            $device->where('product', $request->input('product'));
        }
        if($request->input('device_name')) {
            $device->where('name', $request->input('device_name'));
        }
        return view('searchResults')->with('devices',$device);


        /*$pass = User::find(Auth::user()->id)->password;
        if(Hash::check($request->input('pass'),$pass)) {
            User::find(Auth::user()->id)->delete();
            sleep(1);
            return redirect('https://docs.google.com/forms/d/e/1FAIpQLScH7GsalSCBnbTY9D_18zSVjW-qGKdBDNJYCBA-6WB76WJL8g/viewform?usp=sf_link');
        }
        return back()->with('result', 'パスワードが違います');*/
    }

}