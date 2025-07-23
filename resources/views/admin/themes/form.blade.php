<form method="POST" action="{{ route('settings.update') }}"
      id="frm_update_theme_mode">
    @method('PUT')
    @csrf
    <div class="form-group">
        <select class="form-control select2" name="setting[theme_mode]" id="setting_theme_mode">
            <option
                value="{{ App\Models\Theme::LIGHT }}" {{ $themeMode == App\Models\Theme::LIGHT ? 'selected' : '' }}> {{trans('global.light')}}</option>
            <option
                value="{{ App\Models\Theme::DARK }}" {{ $themeMode == App\Models\Theme::DARK ? 'selected' : '' }}> {{trans('global.dark')}}</option>
        </select>

    </div>
</form>
