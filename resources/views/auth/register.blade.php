
@extends('layouts.app')

<link href="{{ asset('css/Register.css') }}" rel="stylesheet">

<script href="{{ asset('js/Register.js') }}" type="text/javascript"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="Registration">
                        <div class="Regist-padding">
                            <a >新規登録</a>
                        </div>
                        <hr color="black" size="1"></hr>

                        <div class ="paddings">
                            @error('name')
{{--                            <span class="invalid-feedback" role="alert">--}}
                                <span style="color: red">{{ $message }}</span>
{{--                            </span>--}}
                            @enderror
                            <br>
                            <br>
                            <a>ユーザー名</a>
                            <input id="name" type="text" class="textlines @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザー名を入力してください。">
                            @error('User_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br><br>

                            {{--<div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>--}}

                            <a>パスワード</a>
                            <input id="password" type="password" class="textlines @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" minlength="8" placeholder="パスワードを入力してください。">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br><br>
                            <a>パスワード(確認)</a>
                            <input id="password-confirm" type="password" class="textlines" name="password_confirmation" required autocomplete="new-password" placeholder="パスワードを再入力してください。">

                            <br><br>
                            <a>利用規約</a>
                            <br>
                            <div class="terms" >
                                <p>ここに利用規約を表示</p>
                            </div>
                            <div style="text-align: center;">
                                <label >
                                    <input type="checkbox" name="agree" id="agree" value="" required="required">利用規約に同意します
                                </label>
                                <br><br>
                                <button name="confirm" type="submit" class="btn1" id="submit" value="submit" readonly="readonly">
                                    {{ __('ユーザー登録') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
