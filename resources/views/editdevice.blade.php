@extends('layouts.app')
<link href="{{ asset('css/editdevice.css') }}" rel="stylesheet">
@section('content')
    <div class="device_edit">

            <div class="tab_wrap">
                <input id="tab1" type="radio" name="tab_btn" checked>
                <input id="tab2" type="radio" name="tab_btn">
                <input id="tab3" type="radio" name="tab_btn">

                <div class="tab_area">
                    <label class="tab1_label" for="tab1">区分名の変更</label>
                    <label class="tab2_label" for="tab2">区分の削除</label>
                    <label class="tab3_label" for="tab3">共有オプション</label>
                </div>

                <div class="panel_area">
                    <div id="panel1" class="tab_panel">
                        <form method="POST" action="{{ action('EditDeviceController@editDevice', ['id'=>$device_id])}}">
                            @csrf
                            <a>区分名 </a><br><input class="btn5" type="text" name="manufacturer" value="{{$device_name}}" placeholder="メーカー名" maxlength="15" required><br>
                            <a>メーカー名 </a><br><input class = "btn5" type="text" name="new_manufacturer" value="{{$device_manufacturer}}" maxlength="15" required><br>
                            <a>製品番号 </a><br><input class = "btn5" type="text" name="new_product" value="{{$device_product}}"><br><br>
                            <input type="submit" class="btn btn-success" value="保存する" style="width: 100px">
                            <br><br><input type="button" class="btn btn-success" value="戻る" style="width: 100px" onclick="location.href='{{url('/')}}'">
                        </form>
                    </div>


                    <div id="panel2" class="tab_panel">
                        <form method="POST" action="{{ action('HomeController@deleteDevice', ['id'=>$device_id])}}">
                            @csrf
                            @method('delete')
                            <div class ="delee">
                                <a>この区分を削除しますか</a><br><br>
                                <input type="submit" class="btn btn-success" value="はい" style="width: 100px">
                                <input type="button" class="btn btn-success" value="いいえ" style="width: 100px" onclick="location.href='{{url('/')}}'">
                            </div>
                        </form>

                    </div>
                    <div id="panel3" class="tab_panel">
                        <div class="sample3Area" id="makeImg">
                            <form name ="sti" method="POST" action="{{ action('EditDeviceController@sharebutton' ,['id'=>$device_id])}}">
                                @csrf
                                <a>共有を許可する</a><br>
                                <input type="checkbox" id="mycheck" value="hantei" name ="hantei"
                                <?php
                                if($device_shared>=1){
                                    echo "checked";
                                }else{
                                    echo "";
                                }
                                ?>>
                                <label class="check" for="mycheck"><div></div>
                                </label>
                                <br>
                                <input type="submit" class="btn btn-success" value="設定を保存" style="width: 100px">
                                <br><br><input type="button" class="btn btn-success" value="戻る" style="width: 100px" onclick="location.href='{{url('/')}}'">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
