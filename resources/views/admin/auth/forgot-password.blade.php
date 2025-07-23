@extends('layouts.admin.app')
@section('content')
    <section class="login-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <div class="login-form-str">
                        <h2 class="login-form-str-h2">{{ trans('translation.forgot_password') }}?</h2>
                        <p class="login-form-str-p">{{ trans('translation.email_instruction') }}.</p>

                        <form action="{{route('forgotPasswordPost')}}" method="post">
                            @csrf

                            <div class="mar-17">
                                <label class="Youremail" for="">{{ trans('translation.your_email') }}</label>
                                <input type="email" name="email" class="login-input" placeholder="Enter your email" required>
                            </div>
                            <div class="mar-17">
                                <button type="submit" class="login-bt">{{ trans('translation.submit') }}</button>
                            </div>

                        </form>

                        <p class="accountyet"><a href="{{ route('login') }}"> {{ trans('translation.back_to_login') }}</a></p>
                   </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')