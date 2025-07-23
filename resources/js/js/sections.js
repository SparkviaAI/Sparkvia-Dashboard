/* global $, token */

$(() => {
    const $sortableUl = $('#sortable');
    const $removeSection = $('.remove-section');

    $(document).on('change', '.image-input', function (event) {
        let reader = new FileReader();
        reader.onload = (e) => {
            $(this).closest('.form-group').find('.image-preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);

    });

    $(document).on('click', '.cancel-btn', function (event) {
        $('.image-preview').each(function () {
            $(this).attr('src', $(this).attr('data-original-img'));
        });
    });

    $(document).on('click', '.add-section', function (event) {
        let sectionID = $(this).attr('data-id');
        let pageID = $('#pageID').val();
        $('#section_id').val(sectionID);
        $('#page_id').val(pageID);
        $('#section-duplicate').submit();
    });

    $sortableUl.sortable({
        placeholder: 'ui-state-highlight',
        stop: function (e, ui) {
            let params = [];
            $.map($(this).find('li'), function (el) {
                let record = {
                    id: el.id,
                    order: $(el).index()
                };
                params.push(record);
            });
            $.ajax({
                type: 'PUT',
                url: $('#update_section_url').val(),
                data: {
                    params: params
                },
                success: function (data) {
                }
            });
        }
    });
    $sortableUl.disableSelection();

    let $formId = '';
    $removeSection.on('click', function (e) {
        $('#removeSectionModal').modal('show');
        $formId = $(this).data('form-id');
    });

    $(document).on('click', '#btn-confirm-remove-section', function (event) {
        $('#section-' + $formId).submit();
    });
});
