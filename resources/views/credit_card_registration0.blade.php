{{-- <script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe_public_key = '{{ config('payment.stripe_public_key') }}';
</script>
<script src="{{asset('js/payment.js')}}"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">クレジットカード登録</div>

                <div class="card-body">
                    <form action="{{route('user.payment.store')}}" class="card-form" id="form_payment" method="POST">
                        @csrf
                        <div class="form-group">
                           <label for="name">カード番号</label>
                           <div id="cardNumber"></div>
                        </div>

                        <div class="form-group">
                           <label for="name">セキュリティコード</label>
                           <div id="securityCode"></div>
                        </div>

                        <div class="form-group">
                           <label for="name">有効期限</label>
                           <div id="expiration"></div>
                        </div>

                        <div class="form-group">
                           <label for="name">カード名義</label>
                           <input type="text" name="cardName" id="cardName" class="form-control" value="" placeholder="カード名義を入力">
                        </div>
                        <div class="form-group">
                           <button type="submit" id="create_token" class="btn btn-primary">カードを登録する</button>
                        </div>
                    </form>
                    <a href="{{route('user.payment')}}">クレジットカード情報ページに戻る</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@extends('layouts.header_footer_layout')

@inject('validations', 'App\Http\Controllers\ValidationsController')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/credit_card_registration_style.css') }}">

@php
//dd(session());
@endphp

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                クレジットカードの登録
            </div>
            <div class="heading-image inversion"></div>
        </div>

        {{-- {{ Form::open(['action' => ['RegistrationController@creditCardConfirm'], 'method' => 'post', 'id' => 'payment-form']) }} --}}
        {{ Form::open(['method' => 'post', 'id' => 'payment-form']) }}
            {{ Form::token() }}<!--CSRFトークン-->

            <!-- 基本情報 -->
            <div class="items-container">

                <div class="item-heading">
                    <img src="{{ asset('/images/credit_card_registration/credit_card.png') }}">
                    <div class="item-heading-title">クレジットカード情報</div>
                </div>

                <hr class="width-line">

                <div class="items">
                    <div class="item">
                        <div class="item-title">番号</div>
                        <div class="item-content">
                            {{ Form::number('number') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">有効期限</div>
                        <div class="item-content">
                            <div class="period">
                                {{ Form::number('year', '', ['placeholder' => '年']) }}
                            </div>
                            <div class="period-slash">/</div>
                            <div class="period">
                                {{ Form::number('month', '', ['placeholder' => '月']) }}
                            </div>
                        </div>

                    </div>

                    <div class="item">
                        <div class="item-title">セキュリティコード</div>
                        <div class="item-content">
                            {{ Form::number('code') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">名義</div>
                        <div class="item-content">
                            {{ Form::text('name') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="buttons">
                @if(count($errors) > 0)
                    <div class="error-container">
                        {{ $validations->commonMsgs() }}
                    </div>
                @endif
                <div class="button-container">
                    <button type="button" class="edit" onClick="history.back()">戻る</button>
                    {{ Form::submit('確認') }}
                </div>
            </div>
        {{ Form::close() }}

    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
{{-- <script src="js/payment.js"></script> --}}

<script type="text/javascript">

//const stripe = Stripe(stripe_public_key);
const stripe = Stripe('pk_test_51KENLHHJkC9uqpQdR5vYsNuKODZ2Rbjl0S1Mgho7GFLoYocDk2xS0OoSHvuuf8trqV8fkEw8viCEv1eW22Nsw6w300ZekE4Pog');

// submit時のリスナー
var form = document.getElementById('payment-form');
var card = document.getElementById('number');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Stripeサーバにクレジットカード情報を送信してクレジットカードトークンを取得する
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
alert(result.error.message);
        } else {

alert(result.token.id);

            // クレジットカードトークンを自サーバにsubmitする
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);

    form.appendChild(hiddenInput);
    form.submit();
}

</script>



@endsection
