/* global $, token */

$(() => {
    let $formId = '';
    $(document).on('click', '.remove-page', function (event) {
        $('#removePageModal').modal('show');
        $formId = $(this).data('form-id');
    });

    $(document).on('click', '#btn-confirm-remove-page', function (event) {
        $('#page-' + $formId).submit();
    });
});
