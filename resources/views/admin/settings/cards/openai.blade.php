    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.open_AI_setting') }}</h1>
                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label class="api-label" for="setting[openai_api_key]">{{ trans('translation.openai_api_key') }}</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[openai_api_key]"
                                            value="{{ getSettingByKey(App\Utils\Settings::OPENAI_API_KEY) }}"
                                            id="setting[openai_api_key]" required>
                                        @if($errors->has('openai_api_key'))
                                            <span class="text-danger">{{ $errors->first('openai_api_key') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="setting[engine_id]">{{ trans('translation.default_engine') }}</label>
                                        <select class="api-input select2 {{ $errors->has('engine') ? 'is-invalid' : '' }}"
                                                name="setting[engine_id]" id="setting[engine_id]">
                                            @foreach($engines as $id => $entry)
                                                <option
                                                    value="{{ $id }}" {{ (getSettingByKey(App\Utils\Settings::ENGINE_ID) ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('engine_id'))
                                            <span class="text-danger">{{ $errors->first('engine_helper') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="setting[default_max_tokens]">{{ trans('translation.default_max_tokens') }}</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[default_max_tokens]"
                                            value="{{ getSettingByKey(App\Utils\Settings::DEFAULT_MAX_TOKENS) }}"
                                            id="setting[default_max_tokens]" required>
                                        @if($errors->has('default_max_tokens'))
                                            <span class="text-danger">{{ $errors->first('default_max_tokens') }}</span>
                                        @endif
                                    </div>
                                    <div class="button-input">
                                        <button class="bt-all Add-Category" type="submit">{{ trans('translation.save') }}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
