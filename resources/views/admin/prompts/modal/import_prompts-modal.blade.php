<!-- <div id="importPromptModal" class="modal" tabindex="-1" role="dialog"
     aria-labelledby="importPromptModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importPromptModalTitle">
                    {{trans('import.import_prompts')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <label> <a class="btn  btn-info" href="{{asset('templates/prompts.xlsx')}}" >
                                <i class="fas fa-download"></i> {{ trans('import.download_template') }}
                            </a></label>
                    </div>
                    <div class="form-group">
                        <form 
                              method="POST"
                              id="frmImportPrompts"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="customFile">
                                <label class="custom-file-label" for="customFile"></label>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_import_prompts" class="btn btn-danger"><i class="fas fa-upload"></i> {{ trans('import.import') }}</button>
                    <button type="button" class="btn btn-white"
                            data-dismiss="modal">{{ trans('global.cancel') }}</button>

                </div>
            </div>
        </div>
    </div>
</div>


 -->




 <div id="importPromptModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importPromptModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importPromptModalTitle">
                    {{ trans('import.import_prompts') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-div">
                    <label><a class="btn btn-info" href="{{ asset('templates/prompts.xlsx') }}"><i class="fas fa-download"></i> {{ trans('import.download_template') }}</a></label>
                </div>
                <div class="form-div">
                    <form method="POST" id="frmImportPrompts" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" class="form-control" name="file" id="customFile">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_import_prompts" class="btn btn-danger"><i class="fas fa-upload"></i> {{ trans('import.import') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('global.cancel') }}</button>
            </div>
        </div>
    </div>
</div>
