    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.locale_setting') }}</h1>
                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label class="api-label" for="setting[locale_id]">{{ trans('translation.locale') }}</label>
                                        <select class="api-input select2 {{ $errors->has('locale') ? 'is-invalid' : '' }}"
                                                name="setting[locale_id]" id="setting[locale_id]" required>
                                            @foreach($locales as $id => $locale)
                                                <option
                                                    value="{{ $locale->id }}" {{ getSettingByKey(App\Models\Setting::LOCALE) == $locale->id ? 'selected' : '' }}>{{ $locale->title }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('locale'))
                                            <span class="text-danger">{{ $errors->first('locale') }}</span>
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
