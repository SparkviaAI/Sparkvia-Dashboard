    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Customize Colors</h1>
                        <form id="setting-colors-form" method="POST" action="{{ route('settings.colors.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label for="primary_color" class="api-label">Primary Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[primary_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::PRIMARY_COLOR)) }}"
                                            id="setting[primary_color]" required>
                                        @if($errors->has('primary_color'))
                                            <span class="text-danger">{{ $errors->first('primary_color') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="secondary_color">Secondary Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[secondary_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::SECONDARY_COLOR)) }}"
                                            id="setting[secondary_color]" required>
                                        @if($errors->has('secondary_color'))
                                            <span class="text-danger">{{ $errors->first('secondary_color') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="success_color">Success Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[success_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::SUCCESS_COLOR)) }}"
                                            id="setting[success_color]" required>
                                        @if($errors->has('success_color'))
                                            <span class="text-danger">{{ $errors->first('success_color') }}</span>
                                        @endif
                                    </div>                                
                                    <div class="mar-input">
                                        <label class="api-label" for="info_color">Info Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[info_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::INFO_COLOR)) }}"
                                            id="setting[info_color]" required>
                                        @if($errors->has('info_color'))
                                            <span class="text-danger">{{ $errors->first('info_color') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="warning_color">Warning Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[warning_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::WARNING_COLOR)) }}"
                                            id="setting[warning_color]" required>
                                        @if($errors->has('warning_color'))
                                            <span class="text-danger">{{ $errors->first('warning_color') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="required api-label" for="danger_color">Danger Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[danger_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::DANGER_COLOR)) }}"
                                            id="setting[danger_color]" required>
                                        @if($errors->has('danger_color'))
                                            <span class="text-danger">{{ $errors->first('danger_color') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="dark_color">Dark Color</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            type="color"
                                            name="setting[dark_color]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::DARK_COLOR)) }}"
                                            id="setting[dark_color]" required>
                                        @if($errors->has('dark_color'))
                                            <span class="text-danger">{{ $errors->first('dark_color') }}</span>
                                        @endif
                                    </div>

                                    <div class="button-input">
                                        <button class="bt-all Add-Category" type="button" id="setting-colors-btn">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
