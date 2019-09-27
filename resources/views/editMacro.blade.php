@extends('layouts.app')
<link href="{{ asset('css/add_device.css') }}" rel="stylesheet">
@section('content')
    <div>
        <h3>ボタン一覧</h3>
        @foreach($devices as $device)
            <h4>{{$device->name}}</h4>
            @foreach($device->button as $button)
                {{$button->name}}<button onclick="add('{{$button->id}}','{{$button->name}}','{{$device->name}}')">追加</button>
                <br>
            @endforeach
        @endforeach
        <hr>
        <label>マクロ名：
            <input id="macro_name" type="text" name="macro_name" value='{{$macro_name->name}}' required>
        </label>
        <h3>実行リスト</h3>
        <div id="order-list"></div>
        <button onclick="send()">更新</button>
        <form method="POST" action="{{ action('EditMacroController@deleteMacro',['id' => $macro_id]) }}">
            @csrf
            @method('delete')
            <input type="submit" class="button" value="削除">
        </form>
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
                body = body + "<div>"+(items.deviceName)+" : "+items.buttonName+"<button onclick='remove("+index+")'>remove</button>"+"</div>";
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
