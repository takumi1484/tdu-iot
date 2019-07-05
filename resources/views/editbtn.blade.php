@extends('layouts.app')
<link href="{{ asset('css/editbutton.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/userpage1.js') }}" defer></script>
@section('content')
    <div class="button_edit">
        <form method="POST" action="{{ action('HomeController@editButton', $button_id)}}">
            @csrf
            <p>ボタン名の変更</p>
            <input type="text" class="new_botton_name" required maxlength="8" placeholder="新しいボタン名"><br><br>
            <input type="submit" class="button" value="決定"><br><br>
        </form>
        <form method="POST" action="{{ action('HomeController@deleteButton', $button_id)}}">
            @csrf
            <hr>
            <p>ボタンの削除</p>
            <p>ボタンを削除しますか</p>
            @method('delete')
            <input type="submit" class="button" value="はい"> <input type="button" class="button" value="いいえ" onclick="location.href='{{url('/')}}'"><br><br>
        </form>
    </div>
@endsection