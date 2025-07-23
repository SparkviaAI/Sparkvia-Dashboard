@extends('layouts.admin.app')
@section('content')
    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.create_question') }}</h1>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('questions.store') }}">
                            @csrf
                            <div class="form-div">
                                <div class="mar-input">
                                    <label class="required api-label" for="question">{{ trans('translation.question') }}</label>
                                    <input class="api-input" type="text" name="question" id="question" required>
                                    @if($errors->has('question'))
                                        <span class="text-danger">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="type">{{ trans('translation.type') }}</label>
                                    <select class="api-input" name="type" id="question_type" required>
                                        <option value disabled selected>Please Select</option>
                                        @foreach(App\Models\Question::TYPE_SELECT as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type'))
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input">
                                    <label class="required api-label" for="is_required">{{ trans('translation.is_required') }}</label>
                                    <select class="api-input" name="is_required" id="is_required" required>
                                    <option value disabled selected>Please Select</option>
                                        @foreach(App\Models\Question::IS_REQUIRED_SELECT as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('is_required'))
                                        <span class="text-danger">{{ $errors->first('is_required') }}</span>
                                    @endif
                                </div>
                                <div class="mar-input" id="options_group">
                                    <label class="required api-label" for="options">Options</label>
                                    <select class="api-input select2 tags" name="options[]" id="options" multiple>
                                    @foreach(old('options', []) as $option)
                                        <option value="{{ $option }}" selected>{{ $option }}</option>
                                    @endforeach
                                    </select>
                                    @if($errors->has('options'))
                                        <span class="text-danger">{{ $errors->first('options') }}</span>
                                    @endif
                                </div>
                                
                                <div class="mar-input" id="minimum_answer_length_group">
                                    <label class="required api-label" for="minimum_answer_length">{{ trans('translation.minimum_answer_length') }}</label>
                                    <input class="api-input" type="number" name="minimum_answer_length" id="minimum_answer_length"
                                        value="{{ ('0') }}" step="1" required>
                                    @if($errors->has('minimum_answer_length'))
                                        <span class="text-danger">{{ $errors->first('minimum_answer_length') }}</span>
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

    <script>

        $('.select2').select2();

        $('.select2.tags').select2({
            tags: true
        });

        const select = document.querySelector('#question_type');
        const minimumAnswerLengthInput = document.querySelector('#minimum_answer_length_group');
        const optionsInput = document.querySelector('#options_group');

        function toggleHiddenInput() {
            if (select.value === 'single_select') {
                optionsInput.style.display = 'block';
                minimumAnswerLengthInput.style.display = 'none';
            } else {
                optionsInput.style.display = 'none';
                minimumAnswerLengthInput.style.display = 'inline-block';
            }
        }

        toggleHiddenInput();
        select.addEventListener('change', () => {
            toggleHiddenInput();
        });
    </script>
@endsection('content')