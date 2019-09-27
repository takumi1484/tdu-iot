@extends('layouts.app')
<link href="{{ asset('css/support.css') }}" rel="stylesheet">
<script src="{{ asset('js/support.js') }}" type="text/javascript"></script>
@section('content')
   
                
<form action="/confirm" method="post">
    <div class="form-group">
        <label for="inn">ご自身のメールアドレスを入力してください</label>
        <input type="email" name="email" class="mailaddress" id="InputEmail" value="{{ old('email') }}" placeholder="メールアドレス">
        @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email')}}</p>
        @endif
    </div>
    
    <div class="form-group">
        
        <textarea name="message" id="InputMessage" class="form" cols="40" rows="4" placeholder="内容を入力してください">
        {{ old('message') }}
        </textarea>
        @if($errors->has('message'))
            <p class="text-danger">{{ $errors->first('message')}}</p>
        @endif
    </div>
    @csrf
    <div class= "btn-center">
    <button type="submit" name="action" class="btn btn-primary" value="sent">送信する</button>
    </div>    
</form>
                
           
@endsection
