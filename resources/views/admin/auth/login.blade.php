@extends('layouts.admin.app')
@section('content')
    <section class="login-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <div class="login-form-str">
                        <h2 class="login-form-str-h2">{{ trans('translation.welcome_back') }}</h2>
                        <p class="login-form-str-p">{{ trans('translation.login_message') }}</p>

                        <form action="{{route('loginPost')}}" method="post">
                            @csrf

                            <div class="mar-17">
                                <label class="Youremail" for="">{{ trans('translation.login_email') }}</label>
                                <input type="email" name="email" class="login-input" placeholder="email@site.com">
                            </div>
                            <div class="mar-17">
                                <div class="flex-lable">
                                    <label class="Youremail" for="">{{ trans('translation.login_password') }}</label>
                                    <a href="{{ route('forgotPassword') }}" class="for-pss">{{ trans('translation.forgot_password') }}</a>
                                </div>
                                <input type="password" name="password" class="login-input" placeholder="password">
                            </div>
                            <div class="mar-17">
                                <button type="submit" class="login-bt">{{ trans('translation.login') }}</button>
                            </div>

                        </form>

                        <!-- <p class="accountyet">Don't have an account yet? <a href=""> Sign up here</a></p> -->
                   </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')