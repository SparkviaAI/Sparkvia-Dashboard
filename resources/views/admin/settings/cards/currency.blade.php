<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.currency_settings') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="currency_title">{{ trans('cruds.currency.fields.title') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[currency_title]"
                       value="{{ old('currency_title',  getSettingByKey(Settings::CURRENCY_TITLE)) }}"
                       id="setting[currency_title]" required>
                @if($errors->has('currency_title'))
                    <span class="text-danger">{{ $errors->first('currency_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.currency_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="currency_code">{{ trans('cruds.currency.fields.code') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[currency_code]"
                       value="{{ old('currency_code', getSettingByKey(Settings::CURRENCY_CODE)) }}"
                       id="setting[currency_code]" required>
                @if($errors->has('currency_code'))
                    <span class="text-danger">{{ $errors->first('currency_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency_symbol">{{ trans('cruds.currency.fields.symbol') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[currency_symbol]"
                       value="{{ old('currency_symbol',  $currency_symbol) }}"
                       id="setting[currency_symbol]" required>
                @if($errors->has('currency_symbol'))
                    <span class="text-danger">{{ $errors->first('currency_symbol') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.currency.fields.symbol_helper') }}</span>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
