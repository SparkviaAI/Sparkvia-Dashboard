@extends('layouts.admin.app')
@section('content')
    <section class="login-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <div class="login-form-str">
                        <h2 class="login-form-str-h2">{{ trans('translation.reset_password') }}</h2>
                        <p class="login-form-str-p">{{ trans('translation.password_instruction') }}.</p>

                        <form action="{{route('updatePasswordPost')}}" method="post">
                            @csrf

                            <div class="mar-17">
                                <label class="Youremail" for="">{{ trans('translation.your_email') }}</label>
                                <input type="email" name="email" class="login-input" value="{{ request()->query('email') }}" required readonly >
                            </div>

                            <div class="mar-17">
                                <div class="flex-lable">
                                    <label class="Youremail" for="password">{{ trans('translation.new_password') }}</label>
                                </div>
                                <input type="password" name="password" class="login-input" placeholder="password">
                                @error('password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mar-17">
                                <div class="flex-lable">
                                    <label class="Youremail" for="">{{ trans('translation.confirm_password') }}</label>
                                </div>
                                <input type="password" name="confirm_password" class="login-input" placeholder="confirm password">
                                @error('confirm_password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mar-17">
                                <button type="submit" class="login-bt">{{ trans('translation.submit') }}</button>
                            </div>

                        </form>
                   </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')