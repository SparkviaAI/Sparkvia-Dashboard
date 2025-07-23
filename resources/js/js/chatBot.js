/* global $, token */

let uploadedDocumentMap = {};
const storeMediaURL = $('#storeMediaURL').val();
const chatBotId = $('#chatBotId').val();
const token = $('#_token').val();

Dropzone.options.imageDropzone = {
    url: storeMediaURL,
    maxFilesize: 2, // MB
    acceptedFiles: '.pdf,.doc,.docx,.txt,.csv',
    maxFiles: 10,
    addRemoveLinks: true,
    autoProcessQueue: true,
    headers: {
        'X-CSRF-TOKEN': token
    },
    params: {
        size: 2,
        chatBot_id: chatBotId
    },
    success: function (file, response) {
        $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">');
    },
    removedfile: function (file) {
        file.previewElement.remove();
        let name = '';
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name;
        } else {
            name = uploadedDocumentMap[file.name];
        }
        $('form').find('input[name="files[]"][value="' + name + '"]').remove();
    },
    init: function () {
    },
    error: function(file, response, xhr) {
        if (typeof xhr !== 'undefined') {
            this.defaultOptions.error(file,xhr.statusText);// use xhr err (from server)
        } else {
            this.defaultOptions.error(file,response);// use default (from dropzone)
        }
        $('#logo_error').html(response);
    }
};

$(() => {
    const $removeFile = $('.remove-files');
    const $btnSubmit = $('#btn_submit');
    const $form = $('#chat-bot-form');

    $btnSubmit.on('click', function (e) {
        e.preventDefault();
        const validator = $form.validate({
            validClass: 'is-valid',
            errorClass: 'is-invalid text-danger',
            errorElement: 'small',
        });
        if (!validator.form()) return false;

        $form.LoadingOverlay('show');
        $form.submit();
    });

    $removeFile.on('click', function (e) {
        let item = $(this).closest('.file-item');
        item.remove();
        let id = $(this).data('id');
        $('form').append('<input type="hidden" name="deletedFiles[]" value="' + id + '">');
    });
});
