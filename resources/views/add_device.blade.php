@extends('layouts.app')
@section('content')
    <div class="add_device">
        <form method="POST" action="{{ action('HomeController@addDevice')}}">
            @csrf
            <button type="submit"class="trash_btn"><img src="{{ asset('img/add_btn.png') }}" class="btn3"></button>
            <input type="text" name="manufacturer" placeholder="メーカー名" required>
            <input type="text" name="product" placeholder="製品名">
            <input class="btn5" type="text" name="device_name" placeholder="新しい区分を作成" required>
        </form>
        <hr>
        <p>共有されている機器をコピーする</p>
        <form method="POST" action="{{ action('')}}">
            @csrf
            <input type="text" name="manufacturer" placeholder="メーカー名(必須)" required>
            <input type="text" name="product" placeholder="製品名">
            <input type="text" name="device_name" placeholder="区分名">
            <input type="submit" class="button" value="検索">
        </form>
        <input type="button" class="button" value="戻る" onclick="location.href='{{url('/')}}'"><br><br>
    </div>
@endsection
