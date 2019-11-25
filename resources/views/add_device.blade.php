@extends('layouts.app')
<link href="{{ asset('css/add_device.css') }}" rel="stylesheet">
@section('content')
    <div class="add_device">
        <div class="tab_wrap">
            <input id="tab1" type="radio" name="tab_btn" checked>
            <input id="tab2" type="radio" name="tab_btn">
            <input id="tab3" type="radio" name="tab_btn">

            <div class="tab_area">
                <label class="tab1_label" for="tab1">区分を作成</label>
                <label class="tab2_label" for="tab2">区分をコピー</label>
                <label class="tab3_label" for="tab3">マクロを作成</label>
            </div>

            <div class="panel_area">
                <div id="panel1" class="tab_panel">
                    <form method="POST" action="{{ action('HomeController@addDevice')}}">
                        @csrf
                        <p>区分を作成</p>
                        <input class="btn5" type="text" name="manufacturer" placeholder="メーカー名" maxlength="15" required><br>
                        <input class="btn5" type="text" name="product" placeholder="製品名(型番)" maxlength="20"><br>
                        <input class="btn5" type="text" name="device_name" placeholder="区分名" maxlength="15" required><br><br>
                        <button type="submit"class="btn btn-success" style="width: 100px">追加</button>
                        <br><br><input type="button" class="btn btn-success" value="戻る" style="width: 100px" onclick="location.href='{{url('/')}}'">
                    </form>
                </div>
                <div id="panel2" class="tab_panel">
                    <p>共有されている機器をコピーする</p>
                    <form method="POST" action="{{ action('ShareController@searchData')}}">
                        @csrf
                        <input class = "btn5" type="text" name="manufacturer" placeholder="メーカー名(必須)" maxlength="15" required><br>
                        <input class = "btn5" type="text" name="product" placeholder="製品名(型番)"><br>
                        <input class = "btn5" type="text" name="device_name" placeholder="区分名" maxlength="15"><br><br>
                        <input type="submit" class="btn btn-success" value="検索" style="width: 100px">
                        <br><br><input type="button" class="btn btn-success" value="戻る" style="width: 100px" onclick="location.href='{{url('/')}}'">
                    </form>
                </div>
                <div id="panel3" class="tab_panel">
                    <p>マクロを作成</p>
                    <input type="submit" class="btn btn-success" value="作成" style="width: 100px" onclick="location.href='{{url('macro')}}'">
                    <br><br><input type="button" class="btn btn-success" value="戻る" style="width: 100px" onclick="location.href='{{url('/')}}'">
                </div>
            </div>
        </div>
{{--        <form method="POST" action="{{ action('HomeController@addDevice')}}">--}}
{{--            @csrf--}}
{{--            <p>区分を作成</p>--}}
{{--            <input class="btn5" type="text" name="manufacturer" placeholder="メーカー名" maxlength="15" required><br>--}}
{{--            <input class="btn5" type="text" name="product" placeholder="製品名(型番)" maxlength="20"><br>--}}
{{--            <input class="btn5" type="text" name="device_name" placeholder="区分名" maxlength="15" required><br><br>--}}
{{--            <button type="submit"class="button">追加</button>--}}
{{--        </form>--}}
{{--        <hr>--}}
{{--        <p>共有されている機器をコピーする</p>--}}
{{--        <form method="POST" action="{{ action('ShareController@searchData')}}">--}}
{{--            @csrf--}}
{{--            <input class = "btn5" type="text" name="manufacturer" placeholder="メーカー名(必須)" maxlength="15" required><br>--}}
{{--            <input class = "btn5" type="text" name="product" placeholder="製品名(型番)"><br>--}}
{{--            <input class = "btn5" type="text" name="device_name" placeholder="区分名" maxlength="15"><br><br>--}}
{{--            <input type="submit" class="button" value="検索"><br><br>--}}
{{--        </form>--}}

{{--        <hr>--}}
{{--        <p>マクロを作成</p>--}}

{{--        <input type="submit" class="button" value="作成" onclick="location.href='{{url('macro')}}'">--}}
{{--        <hr>--}}
    </div>
@endsection
