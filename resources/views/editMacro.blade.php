@extends('layouts.app')
<link href="{{ asset('css/editmacro.css') }}" rel="stylesheet">
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
            <input id="macro_name" type="text" name="macro_name" class="name" value='{{$macro_name->name}}' required>
        </label>
        <h5>実行リスト</h5>
        <div id="order-list"></div>
        <br>
        <button class="btn btn-success" onclick="send()">更新</button><br><br>
        <form method="POST" action="{{ action('EditMacroController@deleteMacro',['id' => $macro_id]) }}">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-success" value="削除">
        </form>
        <button type="button" class="btn btn-success" onclick="location.href='{{url('/')}}'">戻る</button>
    </div>
    <script type="text/javascript">
        let calls = [];//呼び出し順に配列に格納
        // {画面表示に必要な情報
        // buttonId:buttonId,
        // buttonName:buttonName,
        // deviceName:deviceName
        // }

        // let buttonList = ;

        function getData() {
            let csrf = document.getElementsByName('csrf-token').item(0).content;
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // console.log(this.responseText);
                    console.log(JSON.parse(this.responseText));
                    // calls = JSON.parse(this.responseText);
                    JSON.parse(this.responseText).forEach(elem=>{
                        calls.push({
                            buttonId:elem.button_id,
                            buttonName:elem.button_name,
                            deviceName:elem.device_name
                        });
                        // console.log(elem);
                        updateElement();
                    });

                    // calls = JSON.parse(this.responseText);
                    // JSON.parse(this.responseText)['macro'].forEach(elem=>{
                    //     console.log(elem);
                    //     add(elem['button_id'],elem[''],JSON.parse(this.responseText));
                    // })
                    return JSON.parse(this.responseText);
                } else if (this.readyState === 4) {
                    console.error(this.responseText);
                }
            };
            xhr.open('GET', '{{Request::root()}}/macro/getData/{{$macro_id}}');
            // xhr.setRequestHeader( 'X-CSRF-Token', csrf );
            xhr.send(null);
        }

        getData();

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
            });
            document.getElementById('order-list').innerHTML = body;
        }
        function send() {
            let send = [];
            let macroName = document.getElementById('macro_name').value;
            if(macroName==="")return;
            calls.forEach((items,index)=>{
                send.push({number:index,buttonId:items.buttonId,buttonName:items.buttonName})
            });

            let csrf = document.getElementsByName('csrf-token').item(0).content;
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.location.href = '{{Request::root()}}';//ページ遷移用
                } else if (this.readyState === 4) {
                    console.error(this.responseText);
                }
            };
            xhr.open('POST', '{{Request::root()}}/macro/update/{{$macro_id}}');
            xhr.setRequestHeader( 'Content-Type', 'application/json');
            xhr.setRequestHeader( 'X-CSRF-Token', csrf );
            xhr.send(JSON.stringify({buttons:send,name:macroName}));
        }
    </script>
@endsection
