<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.google_setting') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check">
                    <input class="js-toggle-switch form-check-input"
                           value="1"
                           {{ old('login_by_google', getSettingByKey(Settings::LOGIN_BY_GOOGLE) ) == 1  ? 'checked' : '' }}
                           {{  getSettingByKey(Settings::LOGIN_BY_GOOGLE) ? 'checked' : '' }}
                           name="setting[login_by_google]" id="setting[login_by_google]" type="checkbox">
                    <label class="text-strong"
                           for="setting[login_by_google]">{{ trans('cruds.setting.login_by_google') }}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="setting[google_client_id]">{{ trans('cruds.setting.google_client_id') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[google_client_id]"
                       value="{{ old('google_client_id', getSettingByKey(Settings::GOOGLE_CLIENT_ID)) }}"
                       id="setting[google_client_id]" required>
                @if($errors->has('google_client_id'))
                    <span class="text-danger">{{ $errors->first('google_client_id') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="setting[google_client_secret]">{{ trans('cruds.setting.google_client_secret') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[google_client_secret]"
                       value="{{ old('google_client_secret',  getSettingByKey(Settings::GOOGLE_CLIENT_SECRET)) }}"
                       id="setting[google_client_secret]" required>
                @if($errors->has('google_client_secret'))
                    <span class="text-danger">{{ $errors->first('google_client_secret') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="setting[google_call_back_url]">{{ trans('cruds.setting.google_call_back_url') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[google_call_back_url]"
                       value="{{ old('google_call_back_url', getSettingByKey(Settings::GOOGLE_CALL_BACK_URL)) }}"
                       id="setting[google_call_back_url]" required>
                @if($errors->has('google_call_back_url'))
                    <span class="text-danger">{{ $errors->first('google_call_back_url') }}</span>
                @endif
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
