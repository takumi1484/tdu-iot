@extends('layouts.app')
@section('content')
    <font color="red">
        {{ session('result') }}
    </font>
    <br>
        退会するにはパスワードを入力してOKを押してください。
        <form method="POST"  action="{{ url('postunregister')}}">
            @csrf
            パスワードを入力してください。<br>
            <input type="password" name="pass" required><br>
            <input type="submit" value="OK">
        </form>
@endsection
