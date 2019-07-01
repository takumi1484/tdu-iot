@extends('layouts.app')
<link href="{{ asset('css/userpage1.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/userpage1.js') }}" defer></script>
@section('content')
    <!-- loding -->
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <br>
    <div class="add-control">
        <input class="btn3" type="button" value=" × ">
        <input type="checkbox" class="chk" id="open-close" name="btn0" />
        <label class="btn0 btn0-open-close" for="open-close">
            &nbsp&nbspテレビ
        </label>

        <div class="box0"><div class="name"><input class="btn1" type="button" value="電源"><!-- ←の"電源"を変数に変えてね--><input class="btn2" type="button" value="編集"></div></div>

        <div class="box0"><div class="name"><input class="btn4" type="button" value="＋  ボタンを作成" onclick="location.href='./study.html'"></div></div>




    </div>

    <br>
    <input class="btn3" type="button" value=" + " onclick="location.href='kubun.html'"><label class="btn5">新しい区分を作成</label>

    <hr>
    <div class="box0">
        @foreach($devices as $device)
            {{$device->name}}
            @foreach($device->button as $button)

            @endforeach
            <form method="POST" action="{{action('HomeController@deleteDevice', ['id' => $device->id])}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-primary">ボタンの削除</button>
            </form>
            <form method="POST" action="{{ action('HomeController@addButton')}}">
                @csrf
                <input class="btn3" type="submit" value=" + ">
                <input type="text" name="button_name" placeholder="新しいボタンを作成" required>
                <input type="hidden" name="device_id" value="{{$device->id}}">
            </form>
            <hr>
        @endforeach
    </div>
    <hr>
    <div class="box0">
        <form method="POST" action="{{ action('HomeController@addDevice')}}">
            @csrf
            <input class="btn3" type="submit" value=" + ">
            <input type="text" name="device_name" placeholder="新しい区分を作成" required>
        </form>
    </div>
@endsection
