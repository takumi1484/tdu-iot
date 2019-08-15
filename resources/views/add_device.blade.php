@extends('layouts.app')
<link href="{{ asset('css/add_device.css') }}" rel="stylesheet">
@section('content')
    <div class="add_device">
        <form method="POST" action="{{ action('HomeController@addDevice')}}">
            @csrf
            <p>区分を作成</p>
            <input class="btn5" type="text" name="manufacturer" placeholder="メーカー名" maxlength="15" required><br>
            <input class="btn5" type="text" name="product" placeholder="製品名(型番)" maxlength="20"><br>
            <input class="btn5" type="text" name="device_name" placeholder="区分名" maxlength="15" required><br><br>
            <button type="submit"class="button">追加</button>
{{--            今のところ，テキストボックスはユーザーページの体裁に合わせています--}}
        </form>
        <hr>
        <p>共有されている機器をコピーする</p>
        <form method="POST" action="{{ action('ShareController@searchData')}}">
            @csrf
            <input class = "btn5" type="text" name="manufacturer" placeholder="メーカー名(必須)" maxlength="15" required><br>
            <input class = "btn5" type="text" name="product" placeholder="製品名(型番)"><br>
            <input class = "btn5" type="text" name="device_name" placeholder="区分名" maxlength="15"><br><br>
            <input type="submit" class="button" value="検索"><br><br>
        </form>
        <input type="button" class="button" value="戻る" onclick="location.href='{{url('/')}}'">
    </div>
@endsection
