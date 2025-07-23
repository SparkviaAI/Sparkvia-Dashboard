<div id="newQuestionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newQuestionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newQuestionModalTitle">
                {{ trans('translation.add_question') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.prompts.modal.questions')
                @include('admin.prompts.modal.new-question')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
            </div>
        </div>
    </div>
</div>


