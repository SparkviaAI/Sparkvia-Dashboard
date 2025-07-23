    <!-- <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Brand Setting</h1>
                        <form method="POST" action="{{ route('settings.update-brand') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label class="api-label" for="site_title">Site Title</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[site_title]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::SITE_TITLE)) }}"
                                            id="setting[site_title]" >
                                        @if($errors->has('site_title'))
                                            <span class="text-danger">{{ $errors->first('site_title') }}</span>
                                        @endif

                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="brand_slogan">Slogan</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[brand_slogan]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::BRAND_SLOGAN)) }}"
                                            id="setting[brand_slogan]" >
                                        @if($errors->has('brand_slogan'))
                                            <span class="text-danger">{{ $errors->first('brand_slogan') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="logo">Logo</label>
                                        <div class="api-input needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="brand-logo-dropzone">
                                        </div>
                                        @if($errors->has('logo'))
                                            <span class="text-danger">{{ $errors->first('logo') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="favicon">Favicon</label>
                                        <div class="api-input needsclick dropzone {{ $errors->has('favicon') ? 'is-invalid' : '' }}"
                                            id="favicon-dropzone">
                                        </div>
                                        @if($errors->has('favicon'))
                                            <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="auth_logo">Onboarding Background Image</label>
                                        <div class="api-input needsclick dropzone {{ $errors->has('auth_logo') ? 'is-invalid' : '' }}"
                                            id="auth-logo-dropzone">
                                        </div>
                                        @if($errors->has('auth_logo'))
                                            <span class="text-danger">{{ $errors->first('auth_logo') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="brand_email">Email</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[brand_email]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::BRAND_EMAIL)) }}"
                                            id="setting[brand_email]" >
                                        @if($errors->has('brand_email'))
                                            <span class="text-danger">{{ $errors->first('brand_email') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="brand_address">Address</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[brand_address]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::BRAND_ADDRESS)) }}"
                                            id="setting[brand_address]" >
                                        @if($errors->has('brand_address'))
                                            <span class="text-danger">{{ $errors->first('brand_address') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="brand_phone">Phone</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[brand_phone]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::BRAND_PHONE)) }}"
                                            id="setting[brand_phone]" >
                                        @if($errors->has('brand_phone'))
                                            <span class="text-danger">{{ $errors->first('brand_phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="brand_version">Version</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="setting[brand_version]"
                                            value="{{ (getSettingByKey(App\Utils\Settings::BRAND_VERSION)) }}"
                                            id="setting[brand_version]" >
                                        @if($errors->has('brand_version'))
                                            <span class="text-danger">{{ $errors->first('brand_version') }}</span>
                                        @endif
                                    </div>
                                    <div class="button-input">
                                        <button class="bt-all Add-Category" type="submit">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> -->





<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-scroll">
                    <h1 class="Category_List">{{ trans('translation.brand_setting') }}</h1>
                    <form method="POST" action="{{ route('settings.update-brand') }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-div">
                            <div class="mar-input">
                                <label class="api-label" for="site_title">{{ trans('translation.site_title') }}</label>
                                <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="setting[site_title]"
                                    value="{{ (getSettingByKey(App\Utils\Settings::SITE_TITLE)) }}"
                                    id="setting[site_title]" >
                                @if($errors->has('site_title'))
                                    <span class="text-danger">{{ $errors->first('site_title') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="brand_slogan">{{ trans('translation.slogan') }}</label>
                                <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="setting[brand_slogan]"
                                    value="{{ (getSettingByKey(App\Utils\Settings::BRAND_SLOGAN)) }}"
                                    id="setting[brand_slogan]" >
                                @if($errors->has('brand_slogan'))
                                    <span class="text-danger">{{ $errors->first('brand_slogan') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="logo">{{ trans('translation.logo') }}</label>
                                <div>
                                    @if($logoSetting && $logoSetting->value)
                                        <img src="{{ asset('f_admin/'.$logoSetting->value) }}" alt="Logo" width="100">
                                    @endif
                                </div>
                                <input type="file" name="brand_logo" class="form-control {{ $errors->has('brand_logo') ? 'is-invalid' : '' }}">
                                @if($errors->has('brand_logo'))
                                    <span class="text-danger">{{ $errors->first('brand_logo') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="favicon">{{ trans('translation.favicon') }}</label>
                                <div>
                                    @if($faviconSetting && $faviconSetting->value)
                                        <img src="{{ asset('f_admin/'.$faviconSetting->value) }}" alt="Favicon" width="100">
                                    @endif
                                </div>
                                <input type="file" name="brand_favicon" class="form-control {{ $errors->has('brand_favicon') ? 'is-invalid' : '' }}">
                                @if($errors->has('brand_favicon'))
                                    <span class="text-danger">{{ $errors->first('brand_favicon') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="auth_logo">{{ trans('translation.onboarding_background_image') }}</label>
                                <div>
                                    @if($authSetting && $authSetting->value)
                                        <img src="{{ asset('f_admin/'.$authSetting->value) }}" alt="Auth Logo" width="100">
                                    @endif
                                </div>
                                <input type="file" name="auth_logo" class="form-control {{ $errors->has('auth_logo') ? 'is-invalid' : '' }}">
                                @if($errors->has('auth_logo'))
                                    <span class="text-danger">{{ $errors->first('auth_logo') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="brand_email">{{ trans('translation.email') }}</label>
                                <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="setting[brand_email]"
                                    value="{{ (getSettingByKey(App\Utils\Settings::BRAND_EMAIL)) }}"
                                    id="setting[brand_email]" >
                                @if($errors->has('brand_email'))
                                    <span class="text-danger">{{ $errors->first('brand_email') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="brand_address">{{ trans('translation.address') }}</label>
                                <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="setting[brand_address]"
                                    value="{{ (getSettingByKey(App\Utils\Settings::BRAND_ADDRESS)) }}"
                                    id="setting[brand_address]" >
                                @if($errors->has('brand_address'))
                                    <span class="text-danger">{{ $errors->first('brand_address') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="brand_phone">{{ trans('translation.phone') }}</label>
                                <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="setting[brand_phone]"
                                    value="{{ (getSettingByKey(App\Utils\Settings::BRAND_PHONE)) }}"
                                    id="setting[brand_phone]" >
                                @if($errors->has('brand_phone'))
                                    <span class="text-danger">{{ $errors->first('brand_phone') }}</span>
                                @endif
                            </div>
                            <div class="mar-input">
                                <label class="api-label" for="brand_version">{{ trans('translation.version') }}</label>
                                <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                    name="setting[brand_version]"
                                    value="{{ (getSettingByKey(App\Utils\Settings::BRAND_VERSION)) }}"
                                    id="setting[brand_version]" >
                                @if($errors->has('brand_version'))
                                    <span class="text-danger">{{ $errors->first('brand_version') }}</span>
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


