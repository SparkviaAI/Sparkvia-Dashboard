@extends('layouts.admin.app')
@section('content')

    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Edit Locale</h1>
                        <form method="POST" action="{{ route('locales.update',  ['locale' => $locale->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-div">
                                <div class="mar-input">
                                    <label class="required api-label" for="title">Title</label>
                                    <input class="api-input {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                                        id="title" value="{{ $locale->title }}" required>
                                    @if($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="slug">Slug</label>
                                    <input class="api-input {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ $locale->slug }}" required>
                                    @if($errors->has('slug'))
                                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="flag_name">Flag Name</label>
                                    <input class="api-input {{ $errors->has('flag_name') ? 'is-invalid' : '' }}" type="text" name="flag_name" id="flag_name" value="{{ $locale->flag_name }}" required>
                                    @if($errors->has('flag_name'))
                                        <span class="text-danger">{{ $errors->first('flag_name') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="status">Status</label>
                                    <select name="status" id="status"
                                            class="api-input {{ $errors->has('status') ? 'is-invalid' : '' }}" required>
                                        <option value="1" {{ $locale->status == 1 ? 'selected' : ''}}>Enabled</option>
                                        <option value="0"{{ $locale->status == 0 ? 'selected' : ''}}>Disabled</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
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
    </section>

</div>



@endsection('content')
