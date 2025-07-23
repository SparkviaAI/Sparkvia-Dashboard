/* global $, token */
import Core from './core';

$(() => {
    const $removeRecord = $('.delete-chat-bot');
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [[1, 'desc']],
        pageLength: 100,
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    let $postUrl = '';
    $removeRecord.on('click', function (e) {
        $('#deleteChatBotModal').modal('show');
        $postUrl = $(this).data('post-url');
        const $message = $(this).data('message');
        $('#delete_chatbot_message').html($message);
    });

    $('#btn-confirm-delete-chatBot').click(function () {
        $('#deleteChatBotModal').modal('hide');
        $.ajax({
            method: 'DELETE',
            url: $postUrl,
        }).done(response => {
            console.log(response);
            if (response.success) {
                Core.toastSuccess(response.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                $('#deleteRelatedChatBotModal').modal('show');
            }
        });
    });
});
