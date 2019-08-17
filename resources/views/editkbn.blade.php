@extends('layouts.app')
<link href="{{ asset('css/editdevice.css') }}" rel="stylesheet">
@section('content')
    <div class="device_edit">
        
            <div class="tab_wrap">
                <input id="tab1" type="radio" name="tab_btn" checked>
                <input id="tab2" type="radio" name="tab_btn">
                
                <div class="tab_area">
                    <label class="tab1_label" for="tab1">区分名の変更</label>
                    <label class="tab2_label" for="tab2">共有オプション</label>
                    
                </div>
                <div class="panel_area">
                    <div id="panel1" class="tab_panel">
                    <form method="POST" action="{{ action('EditDeviceController@index', ['id'=>$device_id])}}">
                        @csrf
                        <a>新しい区分名 </a><br><input class = "we" type="text" name="new_name" value="{{$device_name}}" maxlength="15" required><br>
                        <a>新しいメーカー名 </a><br><input class = "we" type="text" name="new_manufacturer" value="{{$device_manufacturer}}" maxlength="15" required><br>
                        <a>新しい製品番号 </a><br><input class = "we" type="text" name="new_product" value="{{$device_product}}"><br><br>
                        <input type="submit" class="save" value="保存する">
                    </form>
                    </div>
                    <div id="panel2" class="tab_panel">
                        <a>共有を許可する</a>
                        <div class="sample3Area" id="makeImg">  
                            <form method="POST" action="{{ action('EditDeviceController@sharebutton')}}">
                                @csrf                     
                                <input type="submit" id="sample3check">
                                <label for="sample3check">
                                <span></span>
                                </label>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
        
    </div>
@endsection
