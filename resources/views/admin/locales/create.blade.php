@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.locale.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.locales.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.locale.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.locale.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.locale.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.locale.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="flag_name">{{ trans('cruds.locale.fields.flag_name') }}</label>
                <input class="form-control {{ $errors->has('flag_name') ? 'is-invalid' : '' }}" type="text" name="flag_name" id="flag_name" value="{{ old('flag_name', '') }}" required>
                @if($errors->has('flag_name'))
                    <span class="text-danger">{{ $errors->first('flag_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.locale.fields.flag_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.locale.fields.status') }}</label>
                <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" required>
                    <option value="1" {{ old('status', '') == 1 ? 'selected' : ''}}>Enabled</option>
                    <option value="0"{{ old('status', '') == 0 ? 'selected' : ''}}>Disabled</option>
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.locale.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>


@endsection
