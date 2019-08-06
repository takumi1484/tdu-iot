@extends('layouts.app')
<link href="{{ asset('css/unsubscribe.css') }}" rel="stylesheet">
@section('content')
    <div class="unregister">
        <font color="red">
            {{ session('result') }}
        </font>
        <br>
        退会するにはパスワードを入力してOKを押してください。
        <form method="POST"  action="{{ url('postunregister')}}">
            @csrf
            <br>
            <input type="password" class="pass" name="pass" placeholder="パスワード" required><br><br>
            <input type="submit" class="button" value="OK">
        </form>
    </div>
@endsection
