@extends('layouts.admin.app')
@section('content')

    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="table-scroll m-36">
                        <h1 class="Category_List">{{ trans('translation.profile') }}</h1>
                        <form method="POST" action="{{ route('profileUpdate') }}" class="js-validate needs-validation" novalidate>
                            @csrf
                            <div class="form-div">
                                <div class="mar-input">
                                    <label class="api-label required" for="name">{{ trans('translation.name') }}</label>
                                    <input class="api-input {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $getUserDetails->name }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="email">{{ trans('translation.email') }}</label>
                                    <input class="api-input {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ $getUserDetails->email }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="button-input">
                                    <button class="bt-all Add-Category" type="submit">{{ trans('translation.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="table-scroll m-36">
                        <h1 class="Category_List">{{ trans('translation.change_password') }}</h1>
                        <form method="POST" action="{{ route('passwordUpdate') }}">
                            @csrf
                            <div class="form-div">
                                <div class="mar-input {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="required api-label" for="password">{{ trans('translation.new_password') }}</label>
                                    <input class="api-input" type="password" name="password" id="password" required>
                                    @if($errors->has('password'))
                                        <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="password_confirmation">{{ trans('translation.repeat_new_password') }}</label>
                                    <input class="api-input" type="password" name="password_confirmation" id="password_confirmation" required>
                                </div>
                                <div class="button-input">
                                    <button class="bt-all Add-Category" type="submit">{{ trans('translation.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection('content')