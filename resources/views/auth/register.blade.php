
@extends('layouts.app')

<link href="{{ asset('/css/Register.css') }}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/Register.js') }}"></script>
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

                        <div class ="paddings">
                            @error('name')
{{--                            <span class="invalid-feedback" role="alert">--}}
                                <span style="color: red">{{ $message }}</span>
{{--                            </span>--}}
                            @enderror
                            <br>
                            <input id="name" type="text" class="textlines @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザー名">
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

                            <input id="password" type="password" class="textlines @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" minlength="8" placeholder="パスワード">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br><br>
                            <input id="password-confirm" type="password" class="textlines" name="password_confirmation" required autocomplete="new-password" placeholder="パスワード(確認)">
                            <br><br>                            

                            <a >所在地の選択</a>
                            <br>  
                            <a >県名</a>                         
                            <select id="ken" class="input" name="ken" require>
                                <option disabled selected value>選択してください</option>
                            </select>
                            @error('ken')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br>
                            <a >市区町村</a>
                            <select id="siku" class="input" name="siku" require>
                                <option disabled selected value>選択してください</option>
                            </select>
                            @error('siku')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br><br>
                            <a>利用規約</a>
                            <br>
                            <div class="terms" >
                                <p>
                                この利用規約（以下，「本規約」といいます。）は，TDU Smart Controller制作チーム（以下，「当チーム」といいます。）が提供するサービス（以下，「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下，「ユーザー」といいます。）には，本規約に従って，本サービスをご利用いただきます。<br><br>
                                第1条（適用）<br>
                                本規約は，ユーザーと当チームとの間の本サービスの利用に関わる一切の関係に適用されるものとします。<br>
                                当チームは本サービスに関し，本規約のほか，ご利用にあたってのルール等，各種の定め（以下，「個別規定」といいます。）をすることがあります。これら個別規定はその名称のいかんに関わらず，本規約の一部を構成するものとします。<br>
                                本規約の規定が前条の個別規定の規定と矛盾する場合には，個別規定において特段の定めなき限り，個別規定の規定が優先されるものとします。<br><br>
                                第2条（利用登録）<br>
                                本サービスにおいては，登録希望者が本規約に同意の上，当チームの定める方法によって利用登録を申請することによって，利用登録が完了するものとします。<br><br>
                                第3条（ユーザー名およびパスワードの管理）<br>
                                ユーザーは，自己の責任において，本サービスのユーザー名およびパスワードを適切に管理するものとします。<br>
                                ユーザーは，いかなる場合にも，ユーザー名およびパスワードを第三者に譲渡または貸与し，もしくは第三者と共用することはできません。当チームは，ユーザー名とパスワードの組み合わせが登録情報と一致してログインされた場合には，そのユーザー名を登録しているユーザー自身による利用とみなします。<br>
                                ユーザー名及びパスワードが第三者によって使用されたことによって生じた損害は，当チームに故意又は重大な過失がある場合を除き，当チームは一切の責任を負わないものとします。<br><br>
                                第4条（禁止事項）<br>
                                ユーザーは，本サービスの利用にあたり，以下の行為をしてはなりません。<br><br>
                                法令または公序良俗に違反する行為<br>
                                犯罪行為に関連する行為<br>
                                当チーム，本サービスの他のユーザー，または第三者のサーバーまたはネットワークの機能を破壊したり，妨害したりする行為<br>
                                当チームのサービスの運営を妨害するおそれのある行為<br>
                                他のユーザーに関する個人情報等を収集または蓄積する行為<br>
                                不正アクセスをし，またはこれを試みる行為<br>
                                他のユーザーに成りすます行為<br>
                                当チームのサービスに関連して，反社会的勢力に対して直接または間接に利益を供与する行為<br>
                                当チーム，本サービスの他のユーザーまたは第三者の知的財産権，肖像権，プライバシー，名誉その他の権利または利益を侵害する行為<br>
                                その他，当チームが不適切と判断する行為<br><br>
                                第5条（本サービスの提供の停止等）<br>
                                当チームは，以下のいずれかの事由があると判断した場合，ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。<br>
                                本サービスにかかるシステムの保守点検または更新を行う場合<br>
                                地震，落雷，火災，停電または天災などの不可抗力により，本サービスの提供が困難となった場合<br>
                                コンピュータまたは通信回線等が事故により停止した場合<br>
                                その他，当チームが本サービスの提供が困難と判断した場合<br>
                                当チームは，本サービスの提供の停止または中断により，ユーザーまたは第三者が被ったいかなる不利益または損害についても，一切の責任を負わないものとします。<br><br>
                                第6条（著作権）<br>
                                本サービスおよび本サービスに関連する一切の情報についての著作権およびその他の知的財産権はすべて当チームまたは当チームにその利用を許諾した権利者に帰属し，ユーザーは無断で複製，譲渡，貸与，翻訳，改変，転載，公衆送信（送信可能化を含みます。），伝送，配布，出版，営業使用等をしてはならないものとします。<br><br>
                                第7条（利用制限および登録抹消）<br>
                                当チームは，ユーザーが以下のいずれかに該当する場合には，事前の通知なく，投稿データを削除し，ユーザーに対して本サービスの全部もしくは一部の利用を制限しまたはユーザーとしての登録を抹消することができるものとします。<br><br>
                                本規約のいずれかの条項に違反した場合<br>
                                当チームからの連絡に対し，一定期間返答がない場合<br>
                                本サービスについて，最終の利用から一定期間利用がない場合<br>
                                その他，当チームが本サービスの利用を適当でないと判断した場合<br>
                                前項各号のいずれかに該当した場合，ユーザーは，当然に当チームに対する一切の債務について期限の利益を失い，その時点において負担する一切の債務を直ちに一括して弁済しなければなりません。<br>
                                当チームは，本条に基づき当チームが行った行為によりユーザーに生じた損害について，一切の責任を負いません。<br><br>
                                第8条（退会）<br>
                                ユーザーは，当チームの定める退会手続により，本サービスから退会できるものとします。<br><br>
                                第9条（保証の否認および免責事項）<br>
                                当チームは，本サービスに事実上または法律上の瑕疵（安全性，信頼性，正確性，完全性，有効性，特定の目的への適合性，セキュリティなどに関する欠陥，エラーやバグ，権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。<br>
                                当チームは，本サービスに起因してユーザーに生じたあらゆる損害について一切の責任を負いません。ただし，本サービスに関する当チームとユーザーとの間の契約（本規約を含みます。）が消費者契約法に定める消費者契約となる場合，この免責規定は適用されません。<br>
                                前項ただし書に定める場合であっても，当チームは，当チームの過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害のうち特別な事情から生じた損害（当チームまたはユーザーが損害発生につき予見し，または予見し得た場合を含みます。）について一切の責任を負いません。<br>
                                当チームは，本サービスに関して，ユーザーと他のユーザーまたは第三者との間において生じた取引，連絡または紛争等について一切責任を負いません。<br><br>
                                第10条（サービス内容の変更等）<br>
                                当チームは，ユーザーに通知することなく，本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし，これによってユーザーに生じた損害について一切の責任を負いません。<br><br>
                                第11条（利用規約の変更）<br>
                                当チームは，必要と判断した場合には，ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお，本規約の変更後，本サービスの利用を開始した場合には，当該ユーザーは変更後の規約に同意したものとみなします。<br><br>
                                第12条（権利義務の譲渡の禁止）<br>
                                ユーザーは，当チームの書面による事前の承諾なく，利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し，または担保に供することはできません。<br><br>
                                第13条（準拠法・裁判管轄）<br>
                                本規約の解釈にあたっては，日本法を準拠法とします。<br>
                                本サービスに関して紛争が生じた場合には，当チームの所在地を管轄する裁判所を専属的合意管轄とします。<br><br>
                                以上
                                </p>
                            </div>
                            <div style="text-align: center;">
                                <label class="form-check-label">
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
