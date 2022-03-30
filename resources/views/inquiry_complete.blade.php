@extends('layouts.home_base_layout')

@inject('validations', 'App\Http\Controllers\ValidationsController')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/registration_style.css') }}">

@php
$register_token = session()->get('register_token');
$register_mail_address = session()->get('register_mail_address');
@endphp

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                お問い合わせ
            </div>
            <div class="heading-image inversion"></div>
        </div>

        <div class="discription">お問い合わせありがとうございました。</div>

        <div class="submit-button-container">
            @if(count($errors) > 0)
                <div class="error-container">
                    {{ $validations->commonMsgs() }}
                    <ul style="list-style: none;text-align: left;">
                        @foreach ($errors->all() as $error)
                          <li style="color:red">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>



        {{ Form::open(['action' => ['RegistrationController@baseInfoConfirm'], 'method' => 'post']) }}
            {{ Form::token() }}<!--CSRFトークン-->

            <!-- お問い合わせ -->
            <div class="items-container first-item">

                <div class="item-heading">
                    <img src="{{ asset('/images/registration/base_info.png') }}">
                    <div class="item-heading-title">お問い合わせ</div>
                    <div class="discription" >下記項目をすべてご記入ください</div>
                </div>

                <hr class="width-line">

                <div class="items">
                    <div class="item">
                        <div class="item-title">会社名</div>
                        <div class="item-content">
                            {{ Form::text('company_name') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">名前</div>
                        <div class="item-content">
                            {{ Form::text('address') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">メールアドレス</div>
                        <div class="item-content">
                            {{ Form::text('phone_number') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">件名</div>
                        <div class="item-content">
                            {{ Form::text('company_rep') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">お問い合わせ内容</div>
                        <div class="item-content">
                            {{ Form::text('mobile_number') }}
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-title">メールアドレス</div>
                        <div class="item-content">
                            <!-- TODO: URLでデータ持ってくる -->
                            {{ Form::text('email_address', $register_mail_address, ['readonly']) }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="submit-button-container">
                @if(count($errors) > 0)
                    <div class="error-container">
                        {{ $validations->commonMsgs() }}
                    </div>
                @endif
                {{ Form::submit('確認画面') }}
            </div>

        {{ Form::close() }}

    </div>
</div>


@endsection
