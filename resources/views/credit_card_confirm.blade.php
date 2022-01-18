@extends('layouts.header_footer_layout')

@section('content')

<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/credit_card_confirm_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                新規登録
            </div>
            <div class="heading-image inversion"></div>
        </div>

        {{ Form::open(['action' => ['RegistrationController@showMailSendView'], 'method' => 'post']) }}
            {{ Form::token() }}　<!--CSRFトークン-->

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
                            {{ Form::number('number', $confirm["number"], ['readonly']) }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">有効期限</div>
                        <div class="item-content">
                            {{ $confirm["year"] }}
                            {{ Form::hidden('year', $confirm["year"], ['readonly']) }}
                            <div class="period slash">/</div>
                            {{ $confirm["month"] }}
                            {{ Form::hidden('month', $confirm["month"], ['readonly']) }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">セキュリティコード</div>
                        <div class="item-content">
                            {{ Form::hidden('code', $confirm["code"], ['readonly']) }}
                            ****
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">名義</div>
                        <div class="item-content">
                            {{ Form::text('name', $confirm["name"], ['readonly']) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="agree-check-container">
                {{ Form::checkbox('agreed', 1, false, ['id'=>'agreed', 'required']) }}
                <label for="agreed" class="checkbox">上記内容で申し込みます</label>
            </div>

            <div class="button-container">
                <button type="button" class="edit" onClick="history.back()">戻る</button>
                {{ Form::submit('申込み', ['id'=>'submit']) }}
            </div>

        {{ Form::close() }}

    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="js/payment.js"></script>

@endsection
