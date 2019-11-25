@extends('layouts.app')
<link href="{{ asset('css/addmacro.css') }}" rel="stylesheet">
@section('content')
    <div align="center">
        <h5>ボタン一覧</h5>
        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($devices as $device)
                <div class="card">
                    <div class="card-header" style="transform: rotate(0);text-align: left" role="tab" id="heading{{$device->id}}">
                        <a class="text-body collapsed stretched-link text-decoration-none" data-toggle="collapse" href="#collapse{{$device->id}}" role="button" aria-expanded="false" aria-controls="collapseOne">
                            {{$device->name}}
                        </a>
                    </div>
                    <div id="collapse{{$device->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$device->id}}" data-parent="#accordion">
                        <div class="card-body">
                            <p style="font-size: x-small">ボタンをタップで追加</p>
                            <table>
                                @foreach($device->button as $button)
                                    <tr>
                                        <td style="text-align: right">{{$button->name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><button class="button2" style="background: {{$button->color}}; border: solid {{$button->color}};" onclick="add('{{$button->id}}','{{$button->name}}','{{$device->name}}')">&nbsp;</button></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <label>マクロ名：
            <input id="macro_name" type="text" name="macro_name" class="name" required>
        </label>
        <h5>実行リスト</h5>
        <div id="order-list"></div>
        <br>
        <button class="btn btn-success" onclick="send()">マクロ作成</button><br><br>
        <button type="button" class="btn btn-success" onclick="location.href='{{url('/')}}'">戻る</button>
    </div>
    <script type="text/javascript">
        let calls = [];//呼び出し順に配列に格納

        function add(buttonId,buttonName,deviceName) {
            calls.push({buttonId:buttonId,buttonName:buttonName,deviceName:deviceName});
            updateElement();
        }
        function remove(index) {
            calls.splice(index, 1);
            updateElement();
        }
        function updateElement() {
            let body = "";
            calls.forEach((items,index)=>{
                body = body + "<table class='list'><tr><td style='text-align: right'>"+(items.deviceName)+"</td><td>"+" : "+items.buttonName+"</td><td><button class='btn btn-outline-secondary btn-sm' onclick='remove("+index+")' style='text-align: center'>取り除く</button></td>"+"</tr></table>";
                // console.log(calls);
            });
            document.getElementById('order-list').innerHTML = body;
        }
        function send() {
            let send = [];
            let macroName = document.getElementById('macro_name').value;
            if(macroName==="")return;
            calls.forEach((items,index)=>{
                send.push({
                    number:index,
                    buttonId:items.buttonId,
                    buttonName:items.buttonName
                })
            });

            let csrf = document.getElementsByName('csrf-token').item(0).content;
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // console.log(this.responseText);
                    document.location.href = '{{ Request::root()}}';//ページ遷移用
                } else if (this.readyState === 4) {
                    console.error(this.responseText);
                }
            };
            xhr.open('POST', '{{ Request::root()}}/macro/add');
            xhr.setRequestHeader( 'Content-Type', 'application/json');
            xhr.setRequestHeader( 'X-CSRF-Token', csrf );
            xhr.send(JSON.stringify({buttons:send,name:macroName}));
            // console.log(JSON.stringify(calls));
        }
    </script>

    {{--    <div id="app">--}}
    {{--        <example-component></example-component>--}}
    {{--    </div>--}}

@endsection
