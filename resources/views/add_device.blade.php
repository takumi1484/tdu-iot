@extends('layouts.app')
<link href="{{ asset('css/add_device.css') }}" rel="stylesheet">
@section('content')
    <div class="add_device">
        <form method="POST" action="{{ action('HomeController@addDevice')}}">
            @csrf
            <p>区分を作成</p>
            <input class="btn5" type="text" name="manufacturer" placeholder="メーカー名" required><br>
            <button type="submit"class="trash_btn"><img src="{{ asset('img/add_btn.png') }}" class="btn3"></button>
            <input class="btn5" type="text" name="product" placeholder="製品名"><br>
            <input class="btn5" type="text" name="device_name" placeholder="区分名" required><br>
{{--            今のところ，テキストボックスはユーザーページの体裁に合わせています--}}
        </form>
        <hr>
        <p>共有されている機器をコピーする</p>
        <form method="POST" action="{{ action('')}}">
            @csrf
            <input type="text" name="manufacturer" placeholder="メーカー名(必須)" required><br>
            <input type="text" name="product" placeholder="製品名"><br>
            <input type="text" name="device_name" placeholder="区分名"><br>
            <input type="submit" class="button" value="検索"><br><br>
        </form>
        <input type="button" class="button" value="戻る" onclick="location.href='{{url('/')}}'">
    </div>
@endsection
