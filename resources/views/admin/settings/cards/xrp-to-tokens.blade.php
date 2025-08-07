@php
$getData = App\Models\XrpConversionRate::where('status',1)->orderBy('id','DESC')->first();
@endphp

    <section class="dasboard-all pages pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Add XRP to Sparks Conversion Rate</h1>
                        <form method="POST" action="{{ route('settings.xrp-conversion-token') }}">
                            @method('PUT')
                            @csrf
                                <input type="hidden" name="id" value="{{ @$getData->id }}">
                                <div class="form-div">
                                    <div class="mar-input">
                                        <label class="api-label" for="xrp_amount">XRP Amount</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}"
                                            value="{{ @$getData->xrp_amount}}"
                                            type="number" step="0.000001" id="xrp_amount"  name="xrp_amount" required>
                                        @if($errors->has('xrp_amount'))
                                            <span class="text-danger">{{ $errors->first('xrp_amount') }}</span>
                                        @endif
                                    </div>
                                    <div class="mar-input">
                                        <label class="api-label" for="sparks_amount">Sparks Tokens</label>
                                        <input class="api-input {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" step="1"
                                            name="sparks_amount"
                                            value="{{@$getData->sparks_amount}}"
                                            id="sparks_amount">
                                        @if($errors->has('sparks_amount'))
                                            <span class="text-danger">{{ $errors->first('sparks_amount') }}</span>
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
