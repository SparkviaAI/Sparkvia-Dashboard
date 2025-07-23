<div class="form-group">
    <select class="select2 form-select form-control"
            style="width: 100% !important;" multiple="multiple"  id="questions" name="questions[]">
        @foreach($questions as $id => $question)
            <option value="{{ $id }}">{{ $question }}</option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-primary shadow-primary btn-lg w-100"
        id="add-question">{{ trans('translation.select_question') }}</button>

<hr style="    margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;">
<h6 class="text-center mb-4"><label>{{ trans('translation.Or_create_question') }}</label></h6>

<!-- <div class="form-div">
    <div class="mar-input">
        <select class="api-input select2" multiple="multiple"  id="questions" name="questions[]">
            @foreach($questions as $id => $question)
                <option value="{{ $id }}">{{ $question }}</option>
            @endforeach
        </select>
    </div>
</div>
<button type="submit" class="btn btn-primary shadow-primary btn-lg w-100"
        id="add-question">Select Question</button>

<hr style="margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;">
<h6 class="text-center mb-4"><label>Or Create Question</label></h6> -->

<!-- <div class="form-div">
    <div class="mar-input">
        <select class="form-control api-input select2" multiple="multiple" id="questions" name="questions[]">
            @foreach($questions as $id => $question)
                <option value="{{ $id }}">{{ $question }}</option>
            @endforeach
        </select>
    </div>
</div>
<button type="submit" class="btn btn-primary shadow-primary btn-lg w-100" id="add-question">Select Question</button>

<hr style="margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;">
<h6 class="text-center mb-4"><label>Or Create Question</label></h6> -->
