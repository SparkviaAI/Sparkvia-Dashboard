<div class="toast" id="successToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000" style="width: auto;background-color: green;justify-content: center;">
    <div class="toast-body">
    {{ trans('translation.question_added_successfully') }}.
    </div>
</div>
<form id="frm_new_question" method="POST" enctype="multipart/form-data" class="js-validate needs-validation" novalidate>
    @csrf
    <input type="hidden" id="new_question_url" value="{{ route('questions.new-question') }}"/>
    <div class="form-div">
        <div class="mar-input">
            <label class="required api-label" for="question">{{ trans('translation.question') }}</label>
            <input class="form-control api-input {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question" id="question" value="" required>
            @if($errors->has('question'))
                <span class="text-danger">{{ $errors->first('question') }}</span>
            @endif
        </div>
        <div class="mar-input">
            <label class="required api-label">{{ trans('translation.type') }}</label>
            <select class="form-control api-input {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="question_type" required>
                <option value="" disabled selected>Please Select</option>
                @foreach(App\Models\Question::TYPE_SELECT as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('type'))
                <span class="text-danger">{{ $errors->first('type') }}</span>
            @endif
        </div>
        <div class="mar-input">
            <label class="required api-label">{{ trans('translation.is_required') }}</label>
            <select class="form-control api-input {{ $errors->has('is_required') ? 'is-invalid' : '' }}" name="is_required" id="is_required" required>
                <option value="" disabled selected>Please Select</option>
                @foreach(App\Models\Question::IS_REQUIRED_SELECT as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('is_required'))
                <span class="text-danger">{{ $errors->first('is_required') }}</span>
            @endif
        </div>
        <!-- <div class="mar-input" id="options_group">
            <label for="options" class="api-label">Options</label>
            <select class="form-control api-input select2 tags {{ $errors->has('options') ? 'is-invalid' : '' }}" name="options[]" id="options" multiple style="width: 100%">
                @foreach(old('options', []) as $option)
                    <option value="{{ $option }}" selected>{{ $option }}</option>
                @endforeach
            </select>
            @if($errors->has('options'))
                <span class="text-danger">{{ $errors->first('options') }}</span>
            @endif
        </div> -->
        <div class="mar-input" id="minimum_answer_length_group">
            <label class="required api-label" for="minimum_answer_length">{{ trans('translation.minimum_answer_length') }}</label>
            <input class="form-control api-input {{ $errors->has('minimum_answer_length') ? 'is-invalid' : '' }}" type="number" name="minimum_answer_length" id="minimum_answer_length" value="0" step="1" required>
            @if($errors->has('minimum_answer_length'))
                <span class="text-danger">{{ $errors->first('minimum_answer_length') }}</span>
            @endif
        </div>
        <div class="mar-input">
            <button class="btn btn-primary shadow-primary" type="button" id="btn-confirm-add-question">{{ trans('translation.create_question') }}</button>
        </div>
    </div>
</form>