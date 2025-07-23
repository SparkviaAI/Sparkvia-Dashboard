/* global invite_url */
import Core from './core';

$(() => {
    const $submitBtn = $('#submit-button');
    const $removeInvite = $('.remove-invite');

    function sendInvitation(event) {
        event.preventDefault();

        const $box = $('#invitation-email');

        if ($box.val().trim() === '') {
            return;
        }

        $submitBtn.prop('disabled', true);
        const email = $box.val();
        const formData = $('#invitation-form').serialize();
        $box.prop('disabled', true);
        $.ajax({
            method: 'POST',
            url: invite_url,
            data: formData,
            success: function (response) {
                Core.toastSuccess(response.message);
                setTimeout(() => location.reload(), 1500);
            },
            error: function (xhr, status, error) {
                const res = JSON.parse(xhr.responseText);
                Core.toastError(res.message);
                setTimeout(() => {
                    $box.prop('disabled', false);
                    $submitBtn.prop('disabled', false);
                }, 1500);
            }
        });
    }

    $submitBtn.click(sendInvitation);

    let $formId = '';
    $removeInvite.on('click', function (e) {
        $('#cancelInvitationModal').modal('show');
        const $title = $(this).data('title');
        const $button = $(this).data('button');
        const $body = $(this).data('body');

        $('#cancelInvitationModalTitle').html($title);
        $('#btn-confirm-cancel-invitation').html($button);
        $('#remove_team_member').html($body);
        $formId = $(this).data('form-id');
    });

    $('#btn-confirm-cancel-invitation').click(function () {
        $('#' + $formId).submit();
    });
});
