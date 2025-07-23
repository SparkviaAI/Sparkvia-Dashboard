<div class="card">
    <div class="card-header">
        {{ trans('menu.settings') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="setting[header_menu_id]">{{ trans('menu.header_menu_id') }}</label>
                <select class="form-control select2 {{ $errors->has('header_menu_id') ? 'is-invalid' : '' }}"
                        name="setting[header_menu_id]" id="setting[header_menu_id]">
                    @foreach($menus as $id => $entry)
                        <option
                            value="{{ $id }}" {{ (old('header_menu_id') ? old('header_menu_id') : getSettingByKey(Settings::HEADER_MENU_ID) ?? '') == $id ? 'selected' : '' }}>
                            {{ $entry }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="setting[footer_menu_id]">{{ trans('menu.footer_menu_id') }}</label>
                <select class="form-control select2 {{ $errors->has('footer_menu_id') ? 'is-invalid' : '' }}"
                        name="setting[footer_menu_id]" id="setting[footer_menu_id]">
                    @foreach($menus as $id => $entry)
                        <option
                            value="{{ $id }}" {{ (old('footer_menu_id') ? old('footer_menu_id') : getSettingByKey(Settings::FOOTER_MENU_ID) ?? '') == $id ? 'selected' : '' }}>
                            {{ $entry }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
