@extends('layouts.admin.app')
@section('content')


    <section class="dasboard-all pages pt-4 pb-4 height100vh">  
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.edit_user') }}</h1>
                        <form method="POST" action="{{ route('users.update', [$user->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-div">
                                <div class="mar-input">
                                    <label class="required api-label" for="name">{{ trans('translation.name') }}</label>
                                    <input class="api-input {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $user->name }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="username">{{ trans('translation.user_name') }}</label>
                                    <input class="api-input {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ $user->username }}" required>
                                    @if($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="email">{{ trans('translation.email') }}</label>
                                    <input class="api-input {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ $user->email }}" required>
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
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
