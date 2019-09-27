@extends('layouts.app')
<link href="{{ asset('css/study.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/userpage1.js') }}" defer></script>
@section('content')
    <form name="set_name">
        <div class="inp">
            <br><br><p>ボタン名を入力してください</p>
            <input class="btn_name" type="text" name="button_name" placeholder="ボタン名" required maxlength="8" size="30vw" rows="1">
            <input type="hidden" name="device_id" value="{{$device_id}}">
            <br>
            <br>
            <p class="message">
                学習開始ボタンを押し、ビープ音が鳴ったら、機器に向けて記憶させたいボタンを押してください。<br>
                ボタン作成後、一度動作確認をして、動かなかったらボタンを削除し、もう一度学習してください。<br>
                注)エアコンは温度、風量等データを一括で送信しているため、温度上下のみ等の利用はできません。
            </p>
            <br><br>
            <div align="center">
                <input id="study_start" type="button" value="学習開始" class="button" onclick="startStudy()">
            </div>
        </div>
    </form>
    <script>
        function loopSleep(_loopLimit,_interval, _mainFunc){
            var loopLimit = _loopLimit;
            var interval = _interval;
            var mainFunc = _mainFunc;
            var i = 0;
            var loopFunc = function () {
                var result = mainFunc(i);
                if (result === false) {
                    // break機能
                    return;
                }
                i = i + 1;
                if (i < loopLimit) {
                    setTimeout(loopFunc, interval);
                }
            };
            loopFunc();
        }

        function startStudy(){
            var obj = document.getElementById("study_start");
            obj.style.backgroundColor = '#888888';   //
            obj.style.borderColor = '#888888';

            let xmlHttpRequest = new XMLHttpRequest();

            xmlHttpRequest.onreadystatechange = function()
            {
                if( this.readyState === 4 && this.status === 200 )
                {
                    // console.log( this.responseText );
                }else {
                    // console.error("ready state : "+this.readyState+"\n status : "+this.status);
                }
            };
            xmlHttpRequest.open( 'GET','/study/start' );
            xmlHttpRequest.send();

            document.getElementById('study_start').disabled = true;

            let requested = false;
            let IRCheck = new XMLHttpRequest();

            IRCheck.onreadystatechange = function(){
                if( this.readyState === 4 && this.status === 200 ){
                    if (this.responseText.match(/Learn_IR/)){//current_irがlearnのままだったらエラー表示
                        console.log("学習失敗")
                    }else{
                        requested=true;
                        let ir_code = this.responseText.split(/\r\n|\r|\n/)[1];
                        // console.log(ir_code);
                        xmlHttpRequest.open( 'POST','{{ Request::root()}}/api/study/success/{{$device_id}}' );
                        xmlHttpRequest.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
                        xmlHttpRequest.send(`button_name=${document.forms.set_name.button_name.value}&device_id={{$device_id}}&ir_code=${ir_code}`);
                        window.location.href = '/';
                    }
                }else {
                    // console.error("ready state : "+this.readyState+"\nstatus : "+this.status);
                }
            };
           {{-- while (c!==5||requested){--}}
           {{--    setTimeout(()=>{--}}
           {{--        IRCheck.open( 'GET','/api/{{Auth::user()->name}}' );--}}
           {{--        IRCheck.send();--}}
           {{--        c++;--}}
           {{--    },1000)--}}
           {{--}--}}

           loopSleep(180, 1000, function(i){
               IRCheck.open( 'GET','/api/{{Auth::user()->name}}' );
               IRCheck.send();
               if (requested === true) {
                   document.getElementById('study_start').disabled = false;
                   return false;
               }else if(i===180-1){
                   alert("タイムアウト\n" +
                       "3分以内に学習を行なってください");
                   document.getElementById('study_start').disabled = false;
               }
           });




            {{--setTimeout(()=>{--}}
            {{--    let IRCheck = new XMLHttpRequest();--}}

            {{--    IRCheck.onreadystatechange = function(){--}}
            {{--        if( this.readyState === 4 && this.status === 200 ){--}}
            {{--            if (this.responseText.match(/Learn_IR/)){//current_irがlearnのままだったらエラー表示--}}
            {{--                alert("学習失敗:もう一度学習ボタンを押してください")--}}
            {{--            }else{--}}
            {{--                let ir_code = this.responseText.split(/\r\n|\r|\n/)[1];--}}
            {{--                // console.log(ir_code);--}}
            {{--                xmlHttpRequest.open( 'POST','{{ Request::root()}}/api/study/success/{{$device_id}}' );--}}
            {{--                xmlHttpRequest.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );--}}
            {{--                xmlHttpRequest.send(`button_name=${document.forms.set_name.button_name.value}&device_id={{$device_id}}&ir_code=${ir_code}`);--}}
            {{--                window.location.href = '/';--}}
            {{--            }--}}
            {{--        }else {--}}
            {{--            // console.error("ready state : "+this.readyState+"\nstatus : "+this.status);--}}
            {{--        }--}}
            {{--    };--}}
            {{--    IRCheck.open( 'GET','/api/{{Auth::user()->name}}' );--}}
            {{--    IRCheck.send();--}}

            {{--    document.getElementById('study_start').disabled = false;--}}
            {{--},10000)--}}

        }
        //コンパイル?を通さない素のjsなのでvue warnが出る
    </script>
@endsection
