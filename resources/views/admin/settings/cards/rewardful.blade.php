<div class="card">
    <div class="card-header">
        {{ trans('cruds.thirdParty.rewardful_settings') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route_relative("admin.settings.update") }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label
                    for="setting[rewardful_key]">{{ trans('cruds.thirdParty.fields.rewardful_key') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                       name="setting[rewardful_key]"
                       value="{{ old('rewardful_key', getSettingByKey(Settings::REWARDFUL_KEY)) }}"
                       id="setting[rewardful_key]" required>
                @if($errors->has('rewardful_key'))
                    <span class="text-danger">{{ $errors->first('rewardful_key') }}</span>
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

<div class="card">
    <div class="card-header">
        {{ trans('cruds.thirdParty.rewardful_instructions') }}
    </div>
    <div class="card-body">
        <div>
            <p>1- Get your API key from here <a href="https://app.getrewardful.com/company/edit?via=krashless">https://app.getrewardful.com/company/edit?via=krashless</a></p>
            <p>2- Install Rewardful application on your Stripe account from here <a href="https://marketplace.stripe.com/apps/rewardful-affiliate-software">https://marketplace.stripe.com/apps/rewardful-affiliate-software</a></p>
            <p>3- Connect your Rewardful account with Stripe like explained here <a href="https://help.rewardful.com/en/articles/2051884-connect-your-stripe-account">https://help.rewardful.com/en/articles/2051884-connect-your-stripe-account</a></p>
            <p>4. Add your affiliate link to the menu and share it with friends!</p>
        </div>
    </div>
</div>
