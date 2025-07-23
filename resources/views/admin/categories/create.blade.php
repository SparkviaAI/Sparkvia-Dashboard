@extends('layouts.admin.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.create_category') }}</h1>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="form-div">
                                <div class="mar-input">
                                    <label class="required api-label" for="title">{{ trans('translation.title') }}</label>
                                    <input class="api-input" type="text" name="title" id="title" placeholder="{{ trans('translation.title') }}">
                                    @if($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class=" required api-label" for="status">{{ trans('translation.status') }}</label>
                                    <select class="api-input" name="status" id="status" required>
                                        @foreach(App\Models\Category::STATUS_SELECT as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
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