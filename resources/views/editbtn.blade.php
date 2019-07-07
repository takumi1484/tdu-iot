@extends('layouts.app')
<link href="{{ asset('css/editbutton.css') }}" rel="stylesheet">
@section('content')
    <div class="button_edit">
        <form method="POST" action="{{ action('HomeController@editButton', $button_id)}}">
            @csrf
            <p>ボタン名の変更</p>
            <input type="text" class="new_button_name" name="button_name" required maxlength="8" placeholder="新しいボタン名"><br><br>
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