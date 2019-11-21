@extends('layouts.app')
<link href="{{ asset('css/userpage1.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
{{--<script type="text/javascript" src="{{ asset('js/userpage1.js') }}" defer></script>--}}
@section('content')
    <!-- loding -->
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
            {{--<img src="{{ asset('img/loading_spinner.png') }}">--}}
        </div>
    </div>
    <dl>
                    <div class ="tempra">
                    <input id="openWeather" type="checkbox" class="nav-unshown">
                    <label for="openWeather"></label>

                    <label class="nav-unshown" id="nav-close" for="openWeather"></label>
                    <div id="nav-content">
                        <div>室内温度:{{$current_temperature}}℃</div>
                        <div>天気:{{$weather}}</div>
                        <div>天気詳細:{{$weather_description}}</div>
                        <div><img src='../img/{{$weather_icon}}.png' style="width:100px"></div>
                        <div>温度:{{$temp}} ℃</div>
                        <div>最高温度:{{$temp_max}} ℃</div>
                        <div>最低温度:{{$temp_min}} ℃</div>
                        <div>湿度:{{$humidity}} %</div>
                        <div>風速:{{$wind_speed}} m</div>
                        <div>気圧:{{$pressure}} hPa</div>
                    </div>
                    </div><br>
  
                                
        {{ session('status') }}
        @foreach($devices as $device)
            <br>
            <div>
                <dt class="add-control" >
                    <button type="submit" class="btn6"  onclick="location.href='{{action('EditDeviceController@index', ['id'=>$device])}}'"><img src="{{ asset('img/edit_button.png') }}" class="btn3"></button>
                    <div class="toggle-case" data-target="target_{{$device->id}}">
                        {{--                        <input type="checkbox" class="chk" id="open-close" name="btn0" />--}}
                        <div class="btn0 btn0-open-close" for="open-close">
                            <span class="chk-hidden">&nbsp&nbsp{{$device->name}}</span>
                        </div>
                    </div>

                </dt>
                <div class="hidden_box" id="target_{{$device->id}}">
                    @foreach($device->button as $button)
                        <div class="box0">
                            <div class="name">
                                {{--                                <input class="btn1" type="button" value={{$button->name}}>--}}
                                {{--                                <button type="submit" class="btn2">削除</button>--}}
                                <form method="POST"  action="{{ action('IRController@updateIR', ['id' => $button->id])}}">
                                    @csrf
                                    <button type="submit" class="btn1">&nbsp&nbsp{{$button->name}}</button>
                                </form>
                            </div>
                            <button type="submit" class="btn2" onclick="location.href='{{url('button/edit/'.$button->id)}}'">編集</button>
                            <br>
                        </div>
                    @endforeach
                    <div align="center">
                        <input type="button" class="add-btn" onclick="location.href='{{url('/button/study/'.$device->id)}}'" value="ボタンを追加">
                    </div>
                </div>
            </div>
        @endforeach
    </dl>
    <br>
    <div style="margin-top: -20px">
        <hr>
        <dt class="add-control" >
            <button type="submit" class="btn6"  onclick="location.href=''"><img class="btn3"></button>
            <div class="toggle-case" data-target="target_macro">
                <div class="btn0 btn0-open-close" for="open-close">
                    <span class="chk-hidden">&nbsp&nbspマクロ</span>
                </div>
            </div>
        </dt>
        <div class="hidden_box" id="target_macro">
        @foreach($macros as $macro)
            <div class="box0">
                <div class="name">
                    <form method="POST" action="{{ action('apiController@runMacro', [1])}}">
                        @csrf
                        <button type="submit" class="btn1">&nbsp&nbsp{{$macro->name}}</button>
                    </form>
                </div>
                <button type="submit" class="btn2" onclick="location.href='{{action('EditMacroController@index', ['id'=>$macro->id])}}'">編集</button>
                <br>
            </div>
        @endforeach
        </div>
        <hr>
    </div>
    {{--<form method="POST" action="{{ action('HomeController@addDevice')}}">
        @csrf--}}
    <button type="submit" class="trash_btn" onclick="location.href='{{url('/addDevice')}}'"><img src="{{ asset('img/add_btn.png') }}" class="btn3"></button>
    {{--<input class="btn5" type="text" name="device_name" placeholder="新しい区分を作成" required>--}}
    {{--</form>--}}
    <br>
    <script type="text/javascript">
        $(function(){
            $( '.toggle-case' ).click( function(){
                // [data-target]の属性値を代入する
                var targetBox = $( this ).data( 'target' );
                // [target]と同じ名前のIDを持つ要素に[slideToggle()]を実行する
                $( '#' + targetBox ).slideToggle();
                $(this).find('span').toggleClass('chk-shown');
                return false ;
            });
            $('.btn1').click( function(){
                $("#overlay").show();/*fadeIn(500);*/
                setInterval(function(){
                    $("#overlay").fadeOut(500);
                },3000,true);
            });
        });
        //コンパイルを通さない素のjsなのでvue warnが出る
    </script>
@endsection
