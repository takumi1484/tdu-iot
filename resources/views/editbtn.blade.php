@extends('layouts.app')
<link href="{{ asset('css/editbutton.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/userpage1.js') }}" defer></script>
@section('content')
    <div class="button_edit">
        <form method="POST" action="{{ action('EditButtonController@editButton', ['id'=>$button_id])}}">
            @csrf
            <p>ボタン名の変更</p>
            <p>新しい名前</p>
            <input type="text" name="new_name" class="new_botton_name" required><br><br>
            <input type="submit" class="button" value="決定"><br><br>
        </form>
        <form method="POST" action="{{ action('EditButtonController@deleteButton',['id' => $button_id]) }}">
            @csrf
            @method('delete')
            <hr>
            <p>ボタンの削除</p>
            <p>ボタンを削除しますか</p>
            <input type="button" class="button" value="はい"><a>  </a><input type="button" class="button" value="いいえ"><br><br>
        </form>
    </div>
    @endsection