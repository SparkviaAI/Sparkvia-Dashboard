<div class="form-group">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-success" id="btn_new_question">
            {{ trans('translation.add_question') }}
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
        {{ trans('translation.question_list') }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="todo-list sortable" id="sortable" data-widget="todo-list">
                        @if(isset($prompt))
                            @foreach ($prompt->questions as  $question)
                                <!-- <li class="bg-default mb-2 ui-state-highlight question-row" id="{{ $question->id }}"> -->
                                <li class="list-group-item bg-light mb-2 question-row d-flex justify-content-between align-items-center" id="{{ $question->id }}">
                                    <span class="handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <span class="text">{{ $question->question }}</span>
                                    <!-- <div class="float-right">
                                        <small>Shortcode</small>
                                        <small>[Q_{{$question->id}}]</small>

                                        <button class="btn btn-xs btn-success copy-question-code"
                                                data-code-id="[Q_{{$question->id}}]">
                                            Copy
                                        </button>

                                        <button class="btn btn-xs btn-danger remove-question"
                                                data-code-id="[Q_{{$question->id}}]">
                                            Remove
                                        </button>
                                    </div> -->
                                    <div class="btn-group">
                                        <div class="d-flex align-items-center">
                                            <small class="text-muted me-2">{{ trans('translation.shortcode') }}</small>
                                            <small class="text-muted me-2">[Q_{{$question->id}}]</small>
                                        </div>
                                        <button class="btn btn-outline-success btn-sm copy-question-code" data-code-id="[Q_{{$question->id}}]">
                                        {{ trans('translation.copy') }}
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm remove-question" data-code-id="[Q_{{$question->id}}]">
                                        {{ trans('translation.remove') }}
                                        </button>
                                    </div>

                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <p class="card-text w-100">{{ trans('translation.note_question') }}</p>
        </div>
    </div>

    <input type="hidden" id="questions_list" value="{{json_encode($questions)}}">
    <input type="hidden" id="prompt_questions" name="prompt_questions" value="">
    <input type="hidden" id="remove_text"  value="Remove">
    <input type="hidden" id="copy_text"  value=" Copy">
    <input type="hidden" id="short_code"  value=" Shortcode">

</div>
