/* global $, token */

import {SSE} from '../../public/js/sse.js';

$(() => {
    const $el = $('body');
    var boxId;

    const isExpired = $('#isExpired').val();
    const hasReachedLimit = $('#hasReachedLimit').val();
    const clearText = $('#clearText').val();
    const loadingText = $('#loading').val();
    const theme = $('#theme').val();

    function scrollToChatEnd() {
        const objDiv = document.getElementById('chat-box-parent');
        objDiv.scrollTop = objDiv.scrollHeight;
    }

    function replace($el, response) {
        let $oldContent = $el.find('#messages-list');
        $oldContent.replaceWith(response);
    }

    function appendUserMessageBox(message) {
        const list = document.getElementById('messages-list');
        if (!list) {
            $('#chat-box-div').append($('<div id="messages-list"></div>'));
        }

        let e = $('<pre class="bg-soft-primary message">' + message + '</pre>');
        if (theme == 'silicon') {
            e = $('<pre class="bg-secondary message">' + message + '</pre>');
        }
        $('#messages-list').append(e);
    }

    function appendUserStreamMessageBox(id) {
        let e = $('<pre  id="' + id + '" class="bg-soft-secondary message"></pre></>');
        if (theme == 'silicon') {
            e = $('<div><pre  id="' + id + '" class="bg-faded-primary message"></pre></></div>');
        }
        $('#messages-list').append(e);
    }

    function appendAssistantMessageBox(id) {
        const e = $('<div id="loading_div" >' +
            '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' +
            ' <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ' +
            '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>' +
            '</div>');
        $('#' + id).append(e);
    }

    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };

    function submitChat(event) {
        event.preventDefault();

        const $box = $('#message-box');
        const $submitBtn = $('#submit-button');

        if ($box.val().trim() === '') {
            return;
        }

        if (hasReachedLimit == 1) {
            $('#limitReachedModal').modal('show');
            return;
        }

        if (isExpired == 1) {
            $('#planExpiredModal').modal('show');
            return;
        }

        if (!navigator.onLine) {
            var divErrorMessage = document.getElementById('divErrorMessage');
            divErrorMessage.style.display = 'inline-block';
            $('#errorMessage').html(no_connection);
            return;
        }

        $submitBtn.prop('disabled', true);
        const msg = $box.val();
        appendUserMessageBox($box.val());
        $box.val('').prop('disabled', true);
        scrollToChatEnd();
        boxId = Date.now();
        appendUserStreamMessageBox(boxId);
        appendAssistantMessageBox(boxId);

        const eventList = document.getElementById(boxId);
        const url = new URL($('#storeURL').val());

        let evtSource = new SSE(url, {
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': token},
            payload: JSON.stringify({
                'content': msg,
                'role': 'user'
            })
        });
        evtSource.stream();
        var divErrorMessage = document.getElementById('divErrorMessage');
        divErrorMessage.style.display = 'none';

        evtSource.onmessage = (event) => {
            let result = JSON.parse(`${event.data}`);
            if (result != undefined) {
                if (typeof result === 'object' && !Array.isArray(result) && result !== null) {
                    divErrorMessage.style.display = 'inline-block';
                    $('#errorMessage').html(result.message);
                    evtSource.close();
                    $submitBtn.prop('disabled', false);
                    $box.val('').prop('disabled', false).focus();
                } else {
                    if (result == 'finishReasonstop') {
                        evtSource.close();
                        $submitBtn.prop('disabled', false);
                        $box.val('').prop('disabled', false).focus();
                    } else {
                        eventList.innerHTML += result;
                        scrollToChatEnd();
                        $('#loading_div').remove();
                    }
                }
            }
        };
        evtSource.onerror = function (e) {
            evtSource.close();
            $('#loading_div').remove();
            $('#' + boxId).remove();

            $submitBtn.prop('disabled', false);
            $box.val('').prop('disabled', false).focus();
        };
    }

    scrollToChatEnd();
    $('#message-box').val('');
    $('#message-box').on('keyup', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            submitChat(e);
        }
    });

    $('#basic-addon1').click(function (e) {
        e.preventDefault();
        submitChat(e);
    });

    $('#clear-chat-btn').click(function (e) {
        e.preventDefault();

        if (!navigator.onLine) {
            var divErrorMessage = document.getElementById('divErrorMessage');
            divErrorMessage.style.display = 'inline-block';
            $('#errorMessage').html(no_connection);
            return;
        }

        const $chatRow = $('#chat-row');
        if (hasReachedLimit == 1) {
            $('#limitReachedModal').modal('show');
            return;
        }

        if (isExpired == 1) {
            $('#planExpiredModal').modal('show');
            return;
        }

        $chatRow.LoadingOverlay('show');

        $(this).text(loadingText);
        $(this).prop('disabled', true);
        $.ajax({
            type: 'DELETE',
            url: $('#clearURL').val(),
            data: {},
            success: function (response) {
                scrollToChatEnd();
                replace($el, response);

                $('#message-box').val('');

                $chatRow.LoadingOverlay('hide');
                $('#clear-chat-btn')
                    .text(clearText)
                    .prop('disabled', false);
            },
            error: function (xhr, status, error) {
                $chatRow.LoadingOverlay('hide');
                toastError();
                $('#clear-chat-btn')
                    .text(clearText)
                    .prop('disabled', false);
            }
        });
    });

});
