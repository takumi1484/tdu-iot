@extends('layouts.app')
<link href="{{ asset('css/search_result.css') }}" rel="stylesheet">
@section('content')
    <div class="search_device">
        <div align="center">
            <table class="result" border="1">
                <tr align="center"><th>区分名</th><th>製品名</th><th>メーカー名</th><th>コピーする</th></tr>
            <?php $i=0; ?>
            @foreach($devices as $device)
                <tr align="center">
                    <td>{{$device->name}}</td><td>{{$device->product}}</td><td>{{$device->manufacturer}}</td>
                    <td>
                <form method="POST"  action="{{ action('HomeController@copyDevice')}}">
                    @csrf
                    <input type="hidden" name = "id"value="{{ $device->id }}">
                    <button type="submit" class="btn btn-success btn-sm" style="position: relative; top: 6px;">選択</button>
                </form>
                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
            </table>
            <p>検索結果は{{$i}}件です</p>
        </div>

    </div>
@endsection
