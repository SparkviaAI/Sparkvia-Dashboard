    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.chat_setting') }}</h1>
                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label class="api-label" for="setting[chat_engine_id]">{{ trans('translation.default_model') }}</label>
                                        <select class="api-input select2 {{ $errors->has('engine') ? 'is-invalid' : '' }}"
                                                name="setting[chat_engine_id]" id="setting[chat_engine_id]">
                                            @foreach($chatEngines as $id => $entry)
                                                <option
                                                    value="{{ $id }}" {{ (getSettingByKey(App\Utils\Settings::CHAT_ENGINE_ID) ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('chat_engine_id'))
                                            <span class="text-danger">{{ $errors->first('engine_helper') }}</span>
                                        @endif
                                    </div>
                                    <!-- <div class="mar-input">
                                        <label class="api-label" for="setting[chat_chat_bot_id]">Persona</label>
                                        <select class="api-input select2 {{ $errors->has('engine') ? 'is-invalid' : '' }}"
                                                name="setting[chat_chat_bot_id]" id="setting[chat_chat_bot_id]">
                                            @foreach($chatBots as $id => $entry)
                                                <option
                                                    value="{{ $id }}" {{ (getSettingByKey(App\Utils\Settings::CHAT_CHAT_BOT_ID) ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('chat_chat_bot_id'))
                                            <span class="text-danger">{{ $errors->first('engine_helper') }}</span>
                                        @endif
                                    </div> -->
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
