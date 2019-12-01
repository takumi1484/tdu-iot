yarn add cross-env --dev
※よくわかってない

# js,cssの読み込み
1. /public/jsと/public/cssにjs,cssファイルを置く
2. viewのbladeファイル(resources/views/layouts/app.blade.php)のヘッダに`<script src="{{ asset('js/test.js') }}" defer></script>`と`<link href="{{ asset('css/style.css') }}" rel="stylesheet">`を追加
3. これで読み込むはず...

※{{assert()}}はpublicを開く

複雑なコードを書く場合はlaravelMixを使ってsassやjsをコンパイルするのが本来の方法っぽい


<form method="POST" action="XXX">
XXX
    {{action('AdminController@deleteShop', ['id' => $shop->id])}}
    {{ url('admin/shops/add') }}
    {{ route('register') }}
なんかどれも似たような動きする

現状は全件表示になっているのでユーザーごとのボタンのみを表示するようにする

home.bladeでhiddenFormを利用

区分を消したら底に属するボタンをすべて消す

#getルート

/api/get?user=X&device=X&button=X

#ボタン追加連打するとたくさん追加される
->一回追加を押したらjsで無効化する

#middleware設定
url欄からbutton_id,user_idを直接指定した場合に、ログイン中のユーザーの所有するボタン、区分かどうかを確認するmiddlewareを追加
現状、存在しないidを指定すると`Trying to get property 'device' of non-object`というエラーがlaravelから出るため例外処理を考える必要あり

```$xslt
Route::get('/aaaa/{id}','HomeController@study')->middleware('check.button');//CheckButton
Route::get('/aaaa/{id}','HomeController@study')->middleware('check.device');//CheckDevice
```   
というように指定すると`/aaa/{id}`にアクセスする際、button_idもしくはdevice_idからそのbutton,deviceがログイン中のユーザーの物かを調べる
button/edit/1はidが1のボタンを作成したユーザーしか開けない

※Karnel.phpにてmiddlewareを指定





editbtnで削除と演習

web側で学習ボタン（新規ボタン） ＝＞ ロード中を表示+ボタンを無効か
apiルートで以下を表示
“Lean_IR”
“ “
timestamp
＝＞ハード側で学習モードに＝＞信号をコピー＝＞ハードから学習したIRコードがurlに乗せて送信されてくる＝＞ロード中を解除＝＞ボタンをDB登録＝＞ページ遷移

dbの書き換えを検知して画面遷移
0.5秒ごとにdbをチェック


/send/{user_name}?code=IRコード

#2019/12/01
`npm install aws-iot-device-sdk`で[AWS IoT SDK for JavaScript](https://github.com/aws/aws-iot-device-sdk-js)を追加。  
jsでaws-iotのbrokerとやり取りするライブラリ  

=><https://github.com/takumi1484/mqtt-test>
