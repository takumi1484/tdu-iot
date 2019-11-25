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
                <form id="getTemp" action="{{ action('apiController@updateTemparature',['name'=>Auth::user()->name])}}" method="GET">
                    @csrf
                    <div class ="tempra">
                    <a id="temperature" style="color: #6c757d;" >現在の部屋温度</a>
                    {{Auth::user()->current_temperature}}
                    @if(is_numeric(Auth::user()->current_temperature))
                    ℃
                    @endif
                    <button type="submit" class ="btntemp" style="background: #668ad8; color: #FFF; border-bottom: solid 1px #668ad8; border-radius: 4px; margin-left:10px;">更新</button>
                    </div><br>
                </form>

        {{ session('status') }}

        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($devices as $device)
                <button type="submit" class="btn7"  onclick="location.href='{{action('EditDeviceController@index', ['id'=>$device])}}'">
                    <img src="{{ asset('img/edit_button.png') }}" class="btn3">
                </button>
                <div class="card">
                    <div class="card-header" style="transform: rotate(0);" role="tab" id="heading{{$device->id}}" data-target="target_{{$device->id}}">
                        <a class="text-body collapsed stretched-link text-decoration-none" data-toggle="collapse" href="#collapse{{$device->id}}" role="button" aria-expanded="true" aria-controls="collapseOne">{{$device->name}}</a>
                    </div>
                    <div id="collapse{{$device->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$device->id}}" data-parent="#accordion">
                        <div class="card-body">
                            @foreach($device->button as $button)
                                <div style="text-align: center">
                                    {{$button->name}}
                                </div>
                                <div class="box0">
                                    <button type="submit" class="btn6" onclick="location.href='{{url('button/edit/'.$button->id)}}'">
                                        <img src="{{ asset('img/edit_button.png') }}" class="btn3">
                                    </button>
                                    <div class="name">
                                        <form method="POST"  action="{{ action('IRController@updateIR', ['id' => $button->id])}}">
                                            @csrf
                                            <button type="submit" class="btn1" style="background: {{$button->color}};border: solid {{$button->color}};">&nbsp;</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <div align="center">
                                <input type="button" class="btn btn-success btn-sm" onclick="location.href='{{url('/button/study/'.$device->id)}}'" value="ボタンを追加">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </dl>
    <br>
    <div style="margin-top: -20px">
        <hr>
        <div class="accordion2" id="accordion2" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" style="transform: rotate(0);" role="tab" id="heading" data-target="target_macro">
                    <a class="text-body collapsed stretched-link text-decoration-none" data-toggle="collapse" href="#collapse" role="button" aria-expanded="true" aria-controls="collapseOne">マクロ</a>
                </div>
                <div id="collapse" class="collapse" role="tabpanel" aria-labelledby="heading" data-parent="#accordion2">
                    <div class="card-body">
                        @foreach($macros as $macro)
                            <div style="text-align: center">
                                {{$macro->name}}
                            </div>
                            <div class="box0">
                                <button type="submit" class="btn6" onclick="location.href='{{action('EditMacroController@index', ['id'=>$macro->id])}}'">
                                    <img src="{{ asset('img/edit_button.png') }}" class="btn3">
                                </button>
                                <div class="name">
                                    <form method="POST" action="{{ action('apiController@runMacro', [1])}}">
                                        @csrf
                                        <button type="submit" class="btn1" style="background: #5cb85c;border: solid #5cb85c">&nbsp</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<form method="POST" action="{{ action('HomeController@addDevice')}}">
        @csrf--}}
    <br>
    <div class="btn_wrap"><button type="submit" class="trash_btn" onclick="location.href='{{url('/addDevice')}}'"><img src="{{ asset('img/add_btn.png') }}" class="btn3"></button></div>
    <br>
    <script type="text/javascript">
        $(function(){
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
