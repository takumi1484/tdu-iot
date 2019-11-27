<?php

namespace App\Http\Controllers;

use App\Button;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditButtonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $button = Button::where('id',$id);
        $device_id = $button->value('device_id');
        return view('editbtn')->with([
            'device'=>Device::where('id',$device_id),
            'device_id'=>$device_id,
            'buttons'=>Button::where('device_id',$device_id)->get(),
            'status'=>null,
            'button_id'=>$id,
            'button_name'=>Button::where('id',$id)->value('name'),
            'button_color'=>Button::where('id',$id)->value('color')
        ]);
    }

    public function deleteButton($id){
        $mybutton = Button::where('id',$id);
        $device_id = $mybutton->value('device_id');
        $buttons = Button::where('device_id',$device_id)->get();
        foreach ($buttons as $button) {
            if($button->sort_no > $mybutton->value('sort_no')){
                Button::where('id', $button->id)->update([
                    'sort_no' => Button::where('id', $button->id)->value('sort_no') - 1
                ]);
            }
        }
        Button::destroy($id);
        return redirect('/')->with('status', 'ボタンを削除しました');
    }

    public function editButton(Request $request,$id){
        $mybutton = Button::where('id',$id);
        $old_sort_id = $mybutton->value('sort_no');
        $device_id = $mybutton->value('device_id');
        $buttons = Button::where('device_id',$device_id)->get();
        foreach ($buttons as $button) {
            if ($button->sort_no >= $request->sort_no) {
                Button::where('id', $button->id)->update([
                    'sort_no' => Button::where('id', $button->id)->value('sort_no') + 1
                ]);
            }
        }
        if($request->sort_no >= $buttons->count()){
            Button::where('id',$id)->update([
                'name'=>$request->new_name,
                'color'=>$request->new_color,
                'sort_no'=>$request->sort_no -1
            ]);
        }else {
            Button::where('id', $id)->update([
                'name' => $request->new_name,
                'color' => $request->new_color,
                'sort_no' => $request->sort_no
            ]);
        }
        foreach ($buttons as $button){
            if($button->sort_no > $old_sort_id){
                Button::where('id',$button->id)->update([
                    'sort_no'=>Button::where('id',$button->id)->value('sort_no') - 1
                ]);
            }
        }
        return redirect('/')->with('status', 'ボタンを編集しました');
    }


}
