@php
$getWalletData = App\Models\AdminWalletKey::where('network_id',1)->orderBy('id','ASC')->first();
@endphp

    <section class="dasboard-all pages pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Admin System XRP Wallet Key</h1>
                        <form method="POST" action="{{ route('settings.admin-wallet-key') }}">
                            @method('PUT')
                            @csrf
                                <input type="hidden" name="wallet_id" value="{{ @$getWalletData->id }}">
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label class="api-label" for="address">Wallet Address</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="address"
                                            value="{{ @$getWalletData->address}}"
                                            id="address" required>
                                        @if($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="private_key">Private Key</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text"
                                            name="private_key"
                                            value="{{@$getWalletData->pv}}"
                                            id="private_key" required>
                                        @if($errors->has('private_key'))
                                            <span class="text-danger">{{ $errors->first('private_key') }}</span>
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
