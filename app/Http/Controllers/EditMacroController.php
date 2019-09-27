<?php

namespace App\Http\Controllers;

use App\Button;
use App\Device;
use App\Macro;
use App\MacroRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditMacroController extends Controller
{
    public function index($id)
    {
        return view('editMacro')->with([
            'macro_id'=>$id,
            'macro_name'=>Macro::where('id',$id)->first(),
            'devices'=>Device::where('user_id',Auth::id())->get(),
            'status'=>null,
        ]);
    }

    public function getData($id){
        $macros = MacroRelation::where('macro_id',$id)->get();
//        $devices = Device::where('user_id',Auth::id())->get();
//        $data= [];
//        foreach ($devices as $device){
//            $buttons = [];
//            $buttons = Button::where('device_id',$device->id)->get();
//            array_push($data,[
//                'device_id'=>$device->id,
//                'device_name'=>$device->name,
//                'buttons'=>$buttons//複数
//            ]);
//        }

        $existing = [];

        foreach ($macros as $macro){
            array_push($existing,[
                'button_id'=>$macro->button->id,
                'button_name'=>$macro->button->name,
                'device_name'=>$macro->button->device->name,
                'calling_number'=>$macro->calling_number
            ]);
        }
        return $existing;
    }

    public function updateMacro(Request $request, $id){

        Macro::where('id',$id)->update(['name' => $request->name]);

        $macroRelations = MacroRelation::where('macro_id',$id);

        MacroRelation::where('macro_id',$id)->delete();

        foreach ($request->buttons as $button){
            $macroRelation = new MacroRelation;
            $macroRelation->macro_id = $id;
            $macroRelation->button_id = $button["buttonId"];
            $macroRelation->calling_number = $button["number"];
            $macroRelation->save();
        }
    }
    public function deleteMacro($id){
        Macro::destroy($id);
        MacroRelation::where('macro_id',$id)->delete();
        return redirect('/');
    }
}
