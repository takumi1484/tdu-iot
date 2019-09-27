@extends('layouts.app')
<link href="{{ asset('css/editbutton.css') }}" rel="stylesheet">
@section('content')
    <div class="button_edit">
        <form method="POST" action="{{ action('EditButtonController@editButton', ['id'=>$button_id])}}">
            @csrf
            <label class="lab">ボタン名の変更</label>
            <p>新しい名前</p>
            <input type="text" name="new_name" class="new_button_name" required><br><br>
            <input type="submit" class="button" value="決定"><br><br>
        </form>
        <hr>
        <label class="lab">ボタンの削除</label>
        <p>ボタンを削除しますか</p>
        <form method="POST" action="{{ action('EditButtonController@deleteButton',['id' => $button_id]) }}">
            @csrf
            @method('delete')
            <input type="submit" class="button" value="はい">
        </form>
        <input type="button" class="button" value="いいえ" onclick="location.href='{{url('/')}}'"><br><br>
    </div>
@endsection
