<div class="card">
    <div class="card-header">
        {{ trans('cruds.thirdParty.stripe_settings') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <div class="form-check">
                    <input class="js-toggle-switch form-check-input"
                           value="1"
                           {{ old('enable_stripe_payment', getSettingByKey(Settings::ENABLE_STRIPE_PAYMENT) ) == 1  ? 'checked' : '' }}
                           {{ getSettingByKey(Settings::ENABLE_STRIPE_PAYMENT)? 'checked' : '' }}
                           name="setting[enable_stripe_payment]" id="setting[enable_stripe_payment]"
                           type="checkbox">
                    <label class="text-strong"
                           for="setting[enable_stripe_payment]">{{ trans('cruds.setting.enable_stripe_payment') }}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="setting[stripe_key]">{{ trans('cruds.thirdParty.fields.stripe_key') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[stripe_key]"
                       value="{{ old('stripe_key', getSettingByKey(Settings::STRIPE_KEY)) }}"
                       id="setting[stripe_key]" required>
                @if($errors->has('stripe_key'))
                    <span class="text-danger">{{ $errors->first('stripe_key') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="setting[stripe_secret]">{{ trans('cruds.thirdParty.fields.stripe_secret') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[stripe_secret]"
                       value="{{ old('stripe_secret', getSettingByKey(Settings::STRIPE_SECRET)) }}"
                       id="setting[stripe_secret]" required>
                @if($errors->has('stripe_secret'))
                    <span class="text-danger">{{ $errors->first('stripe_secret') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label
                    for="setting[stripe_webhook_secret]">{{ trans('cruds.thirdParty.fields.stripe_webhook_secret') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[stripe_webhook_secret]"
                       value="{{ old('stripe_webhook_secret', getSettingByKey(Settings::STRIPE_WEBHOOK_SECRET)) }}"
                       id="setting[stripe_webhook_secret]" required>
                @if($errors->has('stripe_webhook_secret'))
                    <span class="text-danger">{{ $errors->first('stripe_webhook_secret') }}</span>
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
