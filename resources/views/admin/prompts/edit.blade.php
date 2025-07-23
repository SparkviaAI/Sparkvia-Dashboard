@extends('layouts.admin.app')
@section('content')

    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.edit_prompt') }}</h1>
                        <form method="POST" action="{{ route('prompts.update', [$prompt->id]) }}"
                        enctype="multipart/form-data" id="frm_submit_prompt">
                            @method('PUT')
                            @csrf
                            <div class="form-div">
                                <div class="mar-input">
                                    <label class="required api-label" for="status">{{ trans('translation.status') }}</label>
                                    <select class="api-input" name="status" id="status" required>
                                        @foreach(App\Models\Prompt::STATUS_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ $prompt->status === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="type">{{ trans('translation.type') }}</label>
                                    <select class="api-input" name="type" id="type" required>
                                        @foreach(App\Models\Prompt::TYPE_SELECT as $key => $label)
                                            <option
                                                value="{{ $key }}" {{ $prompt->type === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type'))
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="title">{{ trans('translation.title') }}</label>
                                    <input class="api-input" type="text" name="title"
                                            id="title" required value="{{ $prompt->title }}">
                                    @if($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>                                
                                <div class="mar-input">
                                    <label class="required api-label" for="description"> {{ trans('translation.description') }}</label>
                                    <input class="api-input" type="text"
                                        name="description" id="description" required value="{{ $prompt->description }}">
                                    @if($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>

                                @include('admin.prompts.questions-list')

                                <div class="mar-input">
                                    <label class="required api-label" for="prompt"> {{ trans('translation.prompt') }}</label>
                                    <textarea class="api-input ckeditor {{ $errors->has('prompt') ? 'is-invalid' : '' }}"
                                            name="prompt" id="prompt" required>{!! $prompt->prompt !!}</textarea>
                                    @if($errors->has('prompt'))
                                        <span class="text-danger">{{ $errors->first('prompt') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="engine_id"> {{ trans('translation.engine') }}</label>
                                    <select class="api-input select2 {{ $errors->has('engine') ? 'is-invalid' : '' }}"
                                            name="engine_id" id="engine_id">
                                        @foreach($engines as $id => $entry)
                                            <option
                                                value="{{ $id }}" {{ ($prompt->engine->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('engine'))
                                        <span class="text-danger">{{ $errors->first('engine') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="max_tokens"> {{ trans('translation.max_tokens') }}</label>
                                    <input class="api-input {{ $errors->has('max_tokens') ? 'is-invalid' : '' }}" type="number"
                                        name="max_tokens" id="max_tokens" value="{{ $prompt->max_tokens }}" step="1">
                                    @if($errors->has('max_tokens'))
                                        <span class="text-danger">{{ $errors->first('max_tokens') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="category_id"> {{ trans('translation.category') }}</label>
                                    <select class="api-input select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            name="category_id" id="category_id" required>
                                        @foreach($categories as $id => $entry)
                                            <option value="{{ $id }}" {{ ($prompt->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="chat_bot_id"> {{ trans('translation.chat_bot') }}</label>
                                    <select class="api-input select2 {{ $errors->has('engine') ? 'is-invalid' : '' }}"
                                            name="chat_bot_id" id="chat_bot_id">
                                        @foreach($chatBots as $id => $entry)
                                            <option value="{{ $id }}" {{ ($prompt->chatBot->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('chat_bot_id'))
                                        <span class="text-danger">{{ $errors->first('chat_bot_id') }}</span>
                                    @endif
                                </div>

                                <div class="button-input">
                                    <button class="bt-all Add-Category" type="button" id="btn_submit_prompt">{{ trans('translation.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('admin.prompts.modal.add-question-modal')

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script src="{{ asset('new-js/js/prompts.js') }}"></script>
    <script src="{{ asset('new-js/js/question.js') }}"></script>

@endsection('content')