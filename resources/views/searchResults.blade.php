@extends('layouts.app')
@section('content')
    <div class="search_device">
        {{--<form method="POST" action="{{ action('HomeController@addDevice')}}">
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
        <input type="button" class="button" value="戻る" onclick="location.href='{{url('/')}}'"><br><br>--}}
        <table border="1">
            <tr align="center"><th>区分名</th><th>製品名</th><th>メーカー名</th><th>コピーする</th></tr>
        <?php $i=0; ?>
        @foreach($devices as $device)
            <tr align="center">
                <td>{{$device->name}}</td><td>{{$device->product}}</td><td>{{$device->manufacturer}}</td>
                <td>
            <form method="POST"  action="{{ action('HomeController@copyDevice')}}">
                @csrf
                <input type="hidden" name = "id"value="{{ $device->id }}">
                <button type="submit">選択</button>
            </form>
                </td>
            </tr>
            <?php $i++; ?>
        @endforeach
        </table>
        <p>検索結果は{{$i}}件です</p>

    </div>
@endsection
