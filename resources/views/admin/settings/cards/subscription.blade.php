<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.subscriptions_settings') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.setting.fields.yearly_plan') }}</label>
                <select class="form-control {{ $errors->has('yearly_plan') ? 'is-invalid' : '' }}"
                        name="setting[yearly_plan]" id="setting[yearly_plan]" required>
                    @foreach(App\Models\Setting::YEARLY_PLAN_SELECT as $key => $label)
                        <option
                            value="{{ $key }}" {{ old('yearly_plan', getSettingByKey(Setting::YEARLY_PLAN)) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('setting[yearly_plan]'))
                    <span class="text-danger">{{ $errors->first('setting[yearly_plan]') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.yearly_plan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
