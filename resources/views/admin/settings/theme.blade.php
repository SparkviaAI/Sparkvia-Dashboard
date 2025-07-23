@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.setting.theme_settings') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route_relative('admin.settings.update') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="setting[theme_id]">{{ trans('cruds.setting.fields.theme') }}</label>
                    <select class="form-control select2 {{ $errors->has('theme') ? 'is-invalid' : '' }}"
                            name="setting[theme_id]"
                            id="setting[theme_id]">
                        @foreach ($themes as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('theme_id') ? old('theme_id') : getSettingByKey(Settings::THEME_ID) ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('theme'))
                        <span class="text-danger">{{ $errors->first('locle') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.setting.fields.theme_helper') }}</span>
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
