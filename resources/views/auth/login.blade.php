@extends('layouts.app')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">

                <div class="card-body">
                    <div class="Registration">
                        <div class="Regist-padding">
                            <a>ログイン</a>
                        </div>
                        <br>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class ="paddings">
                            <br>
                                <input id="name" type="text" class="textlines @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザー名">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <br><br>
                                <input id="password" type="password" class="textlines @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br><br>
                            <div style="text-align: center;">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('ログイン情報を保持する') }}
                                    </label>
                                <br><br>
                                <button type="submit" class="btn1">
                                    {{ __('ログイン') }}
                                </button>
                            <br><br><br><br><br>
                        </div>
                        </div>
                    </form>
                </div>
                    </div>
        </div>
    </div>
</div>
@endsection
