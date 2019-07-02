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
    @foreach($devices as $device)

    <br>
    <div class="add-control">
        <form method="POST" action="{{action('HomeController@deleteDevice', ['id' => $device->id])}}">
            @csrf
            @method('delete')
            <button type="submit"class="trash_btn"><img src="{{ asset('img/trash_box.png') }}" class="btn3"></button>
        </form>
        <input type="checkbox" class="chk" id="open-close" name="btn0" />
        <label class="btn0 btn0-open-close" for="open-close">
            &nbsp&nbsp{{$device->name}}
        </label>
        @foreach($device->button as $button)
        <div class="box0">
            <div class="name">
                <input class="btn1" type="button" value={{$button->name}}>
                <form method="POST" action="{{action('HomeController@deleteButton', ['id' => $button->id])}}">
                    @csrf
                    @method('delete')
                        <!--<input class="btn2" type="button" value="編集">-->
                        <button type="submit" class="btn2">削除</button>
                </form>
            </div>
            <br>
        </div>
        @endforeach
        <br>
        <div class="box0">
            <div class="name">
                <!--<input class="btn4" type="button" value="＋  ボタンを作成" onclick="location.href='./study.html'">-->
                <form method="POST" action="{{ action('HomeController@addButton')}}">
                    @csrf
                    <input type="text" class="btn4" name="button_name" placeholder="ボタンを作成" maxlength="8" required>
                    <input type="hidden" name="device_id" value="{{$device->id}}">
                    <button type="submit"class="trash_btn"><img src="{{ asset('img/add_btn.png') }}" class="btn3"></button>
                </form>
                <br>
            </div>
        </div>
        @endforeach
    </div>
    <br>
        <form method="POST" action="{{ action('HomeController@addDevice')}}">
            @csrf
            <button type="submit"class="trash_btn"><img src="{{ asset('img/add_box.png') }}" class="btn3"></button>
            <input class="btn5" type="text" name="device_name" placeholder="新しい区分を作成" required>
        </form>
    <br>
@endsection
