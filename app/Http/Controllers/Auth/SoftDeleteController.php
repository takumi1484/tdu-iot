<?php


namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function deleteData(Request $request)
    {
        $pass = User::find(Auth::user()->id)->password;
        if(Hash::check($request->input('pass'),$pass)) {
            User::find(Auth::user()->id)->delete();
            sleep(1);
            return redirect('https://docs.google.com/forms/d/e/1FAIpQLScH7GsalSCBnbTY9D_18zSVjW-qGKdBDNJYCBA-6WB76WJL8g/viewform?usp=sf_link');
        }
        return back()->with('result', 'パスワードが違います');
    }
}