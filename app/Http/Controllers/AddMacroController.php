<?php

namespace App\Http\Controllers;

use App\Button;
use App\Device;
use App\Macro;
use App\MacroRelation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddMacroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('addMacro')->with([
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'buttons'=>Button::where('device_id',Device::where('user_id',Auth::id())->get()),
            'status'=>null
        ]);
    }

    public function addMacro(Request $request){
//        $macro = new Macro;
//        $macro->name = $request->＃＃＃フォーム名＃＃＃;
//        $macro->user_id = Auth::id();
//        $macro->save();
//
//        $buttons = $request->buttons;//フォームから選択されたボタン(複数)
//        //選択したボタンの数だけ、macro_relationを作成
//        foreach ($buttons as $button){
//            $macroRelation = new MacroRelation;
//            $macroRelation->macro_id = $button[''];
//            $macroRelation->button_id = $button[''];
//            $macroRelation->save();
//        }
//        return redirect('/');
//        echo $request;
        return $request;
    }
    public function removeMacro($id){
        Macro::destroy($id);
        MacroRelation::where('macro_id',$id)->delete();
        return redirect('/');
    }
}
