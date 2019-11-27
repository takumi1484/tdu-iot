@extends('layouts.app')
<link href="{{ asset('css/editbutton.css') }}" rel="stylesheet">
@section('content')
    <div class="button_edit">
        <form method="POST" action="{{ action('EditButtonController@editButton', ['id'=>$button_id])}}">
            @csrf
            <label class="lab">ボタンの変更</label>
            <p>新しい名前と色</p>
            <input type="text" name="new_name" class="new_button_name" maxlength="8" value="{{$button_name}}" required>
            <input type="color" name="new_color" class="color" value="{{$button_color}}">
            <p>
                <select name="sort_no">
                    @foreach($buttons->sortBy('sort_no') as $button)
                        @if($button->id == $button_id)
                            <option value={{$button->sort_no}} selected>並び替えをしない</option>
                        @else
                            <option value={{$button->sort_no}}>{{$button->name}}の前</option>
                        @endif
                    @endforeach
                    <option value={{$buttons->count()}}>一番後ろ</option>
                </select>
            </p>
            <br><br>
            <input type="submit" class="btn btn-success" value="決定"><br><br>
        </form>
        <hr>
        <label class="lab">ボタンの削除</label>
        <p>ボタンを削除しますか</p>
        <form method="POST" action="{{ action('EditButtonController@deleteButton',['id' => $button_id]) }}">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-success" value="はい">
        </form>
        <input type="button" class="btn btn-success" value="いいえ" onclick="location.href='{{url('/')}}'"><br><br>
    </div>
@endsection
