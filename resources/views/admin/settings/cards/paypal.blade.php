<div class="card">
    <div class="card-header">
        {{ trans('cruds.thirdParty.paypal_settings') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <div class="form-check">
                    <input class="js-toggle-switch form-check-input"
                           value="1"
                           {{ old('enable_pp_payment', getSettingByKey(Settings::ENABLE_PP_PAYMENT)  ) == 1  ? 'checked' : '' }}
                           {{ getSettingByKey(Settings::ENABLE_PP_PAYMENT) ? 'checked' : '' }}
                           name="setting[enable_pp_payment]" id="setting[enable_pp_payment]" type="checkbox">
                    <label class="text-strong"
                           for="setting[enable_pp_payment]">{{ trans('cruds.setting.enable_pp_payment') }}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="setting[pp_client]">{{ trans('cruds.thirdParty.fields.pp_client') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[pp_client]"
                       value="{{ old('pp_client', getSettingByKey(Settings::PP_CLIENT)) }}"
                       id="setting[pp_client]" required>
                @if($errors->has('pp_client'))
                    <span class="text-danger">{{ $errors->first('pp_client') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="setting[pp_secret]">{{ trans('cruds.thirdParty.fields.pp_secret') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[pp_secret]"
                       value="{{ old('pp_secret',  getSettingByKey(Settings::PP_SECRET)) }}"
                       id="setting[pp_secret]" required>
                @if($errors->has('pp_secret'))
                    <span class="text-danger">{{ $errors->first('pp_secret') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="setting[pp_env]">{{ trans('cruds.thirdParty.fields.pp_env') }}</label>
                <select class="form-control select2 {{ $errors->has('pp_env') ? 'is-invalid' : '' }}"
                        name="setting[pp_env]" id="setting[pp_env]">
                    <option value
                            disabled {{ old('pp_env', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(Setting::PP_ENV_SELECT as $key => $label)
                        <option
                            value="{{ $key }}" {{ old('pp_env',getSettingByKey(Settings::PP_ENV)) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('pp_env'))
                    <span class="text-danger">{{ $errors->first('pp_env') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label
                    for="setting[pp_webhook_secret]">{{ trans('cruds.thirdParty.fields.pp_webhook_secret') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[pp_webhook_secret]"
                       value="{{ old('pp_webhook_secret', getSettingByKey(Settings::PP_WEBHOOK_SECRET)) }}"
                       id="setting[pp_webhook_secret]" required>
                @if($errors->has('pp_webhook_secret'))
                    <span class="text-danger">{{ $errors->first('pp_webhook_secret') }}</span>
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
