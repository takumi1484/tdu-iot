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