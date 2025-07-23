<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.custom_scripts') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="head_script">{{ trans('cruds.setting.head_script') }}</label>
                <textarea class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[head_script]"
                       id="setting[head_script]" >{!! getSettingByKey(Settings::HEAD_SCRIPT) !!}
                </textarea>
                @if($errors->has('head_script'))
                    <span class="text-danger">{{ $errors->first('head_script') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setting.head_script_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="body_script">{{ trans('cruds.setting.body_script') }}</label>
                <textarea class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                          name="setting[body_script]"
                          id="setting[body_script]" >{!! getSettingByKey(Settings::BODY_SCRIPT) !!}
                </textarea>
                @if($errors->has('body_script'))
                    <span class="text-danger">{{ $errors->first('body_script') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setting.body_script_helper') }}</span>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
