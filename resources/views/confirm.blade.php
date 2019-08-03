@extends('layouts.app')
<link href="{{ asset('css/support.css') }}" rel="stylesheet">
@section('content')
<div class="inn">
    <h4>お問い合わせ内容の確認</h4>
</div>
<div >
    <a class="inn">下記、お問い合わせ内容にて送信します。よろしければ「送信」ボタンを押して下さい。</a>

    <table class="table table-bordered" style ="width:90vw;">
    <tr>
    <td class="table-secondary">メールアドレス</td>
    <td>{{ $email }}</td>
    </tr>
    
    <tr>
    <td class="table-secondary">メッセージ</td>
    <td>{!! nl2br(e($message)) !!}</td>
    </tr>
    </table>

    <form action="sent" method="post">
     @csrf
        <input type="hidden" name="email" class="form-control" id="InputEmail" value="{{ $email }}">
        <input type="hidden" name="message" class="form-control" id="InputMessage" value="{{ $message }}">
    
    
    <button type="submit" name="action" class="btn btn-primary" value="back"style="margin-left:40vw">戻る</button>
    <button type="submit" name="action" class="btn btn-primary" value="sent">送信</button>
    
    </form>
</div>
@endsection