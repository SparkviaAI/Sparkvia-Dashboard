/* global $, token */

import Core from './core';
import {SSE} from '../../../public/js/sse.js';

$(() => {
    const isText = $('#isText').val();
    const isImage = $('#isImage').val();
    const isExpired = $('#isExpired').val();
    const hasReachedLimit = $('#hasReachedLimit').val();
    const hasReachedImageLimit = $('#hasReachedImageLimit').val();
    const createContent = $('#create_content').val();
    const generalError = $('#general_error').val();
    const writing = $('#writing').val();
    const loading = $('#loading').val();
    const promptTitle = $('#prompt_title').val();
    const invalidUrlText = $('#invalid_url_text').val();
    let quill = '';
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };
    const POST = 'POST';

    const isUrl = string => {
        var urlPattern = new RegExp('^(https?:\\/\\/)?' + // validate protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // validate domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))' + // validate OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // validate port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?' + // validate query string
            '(\\#[-a-z\\d_]*)?$', 'i'); // validate fragment locator

        return !!urlPattern.test(string);
    };

    if (isText == 1) {
        quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: $('#editor_placeholder').val()
        });
    }

    function downloadImage(url) {
        fetch(url, {
            mode: 'no-cors',
        })
            .then(response => response.blob())
            .then(blob => {
                let blobUrl = window.URL.createObjectURL(blob);
                let a = document.createElement('a');
                a.download = url.replace(/^.*[\\\/]/, '');
                a.href = blobUrl;
                document.body.appendChild(a);
                a.click();
                a.remove();
            });
    }

    $('#btn-copy').click(function (e) {
        const content = quill.getText();
        let ClipboardHelper = {
            copyText: function (text) {
                let $tempInput = $('<textarea>');
                $('body').append($tempInput);

                $tempInput.val(text).select();
                document.execCommand('copy');
                $tempInput.remove();
            }
        };

        ClipboardHelper.copyText(content);
    });

    $('#btn-download').click(function (e) {
        let text = quill.getText();
        const today = new Date();
        const filename = promptTitle.toLowerCase().replace(/\s/g, '_') + '_' + today.toLocaleString().replace(/\W/g, '_') + '.txt';
        let element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    });

    $('#btn-download-image').click(function (e) {
        const url = document.getElementById('output-image').src;
        if (url) {
            downloadImage(url);
        }
    });

    function scrollToChatEnd() {
        const objDiv = document.getElementById('quill-custom');
        objDiv.scrollTop = objDiv.scrollHeight;
    }

    $('#submit-button').click(function (e) {
        e.preventDefault();

        if (!navigator.onLine) {
            let divErrorMessage = document.getElementById('divErrorMessage');

            divErrorMessage.style.display = 'inline-block';
            $('#errorMessage').html(no_connection);
            return;
        }
        let invalid = false;
        $('.required-questions').each(function () {
            if (this.value == '0') {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
                invalid = true;
            }
        });

        $('.live-crawling').each(function () {
            if (!isUrl(this.value)) {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
                invalid = true;
                let element = $('#live_crawling_' + $(this).attr('id'));
                element[0].style.display = 'inline-block';
                element[0].innerHTML = invalidUrlText;
            }
        });


        if (invalid) {
            return false;
        }

        const validator = $('#content-form').validate({
            validClass: 'is-valid',
            errorClass: 'is-invalid text-danger',
            errorElement: 'small',
        });
        if (!validator.form()) return false;
        if (isText == 1 && hasReachedLimit == 1) {
            $('#limitReachedModal').modal('show');
            return;
        }

        if (isImage == 1 && hasReachedImageLimit == 1) {
            $('#imageLimitReachedModal').modal('show');
            return;
        }

        if (isExpired == 1) {
            $('#planExpiredModal').modal('show');
            return;
        }

        $(this).text(loading);
        $(this).prop('disabled', true);
        $('#empty-state-text').text(writing);
        $('#empty-state').show();
        $('#content-state').hide();
        let divErrorMessage = document.getElementById('divErrorMessage');

        divErrorMessage.style.display = 'none';

        if (isText == 1) {
            let postData = {};
            const url = new URL($('#store_text_url').val());
            $('#content-form').find('input,textarea,select').each(function () {
                postData[this.name] = this.value;
            });

            let evtSource = new SSE(url, {
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': token},
                payload: JSON.stringify(postData)
            });
            evtSource.stream();

            const streamDiv = document.getElementById('streamDiv');

            evtSource.onopen = (e) => {
                $('#editor').toggle();
                $('#streamDiv').addClass('content-body');
            };

            evtSource.onmessage = (event) => {
                let result = JSON.parse(`${event.data}`);
                if (result != undefined) {

                    if (typeof result === 'object' && !Array.isArray(result) && result !== null) {
                        divErrorMessage.style.display = 'inline-block';
                        $('#errorMessage').html(result.message);

                        $('#empty-state').hide();
                        $('#content-state').show();
                        $('#submit-button')
                            .text(createContent)
                            .prop('disabled', false);

                    } else {
                        if (result == 'finishReasonstop') {
                            evtSource.close();
                            quill.clipboard.dangerouslyPasteHTML(streamDiv.outerHTML);
                            $('#empty-state').hide();
                            $('#content-state').show();
                            $('#submit-button')
                                .text(createContent)
                                .prop('disabled', false);

                            $('#streamDiv').html('');
                            $('#editor').toggle();
                            $('#streamDiv').removeClass('content-body');
                            scrollToChatEnd();
                        } else {
                            streamDiv.innerHTML += result;
                            scrollToChatEnd();
                        }
                    }
                }
            };

            evtSource.onerror = function (e) {
                evtSource.close();
                $('#empty-state').hide();
                $('#content-state').show();
                $('#submit-button')
                    .text(createContent)
                    .prop('disabled', false);
            };
        }
        if (isImage == 1) {
            let formData = $('form').serialize();
            $.ajax({
                type: 'POST',
                url: $('#store_image_url').val(),
                data: formData,
                success: function (response) {
                    if (response.success) {
                        document.getElementById('output-image').style.visibility = 'visible';
                        document.getElementById('output-image').src = response.message;
                    } else {
                        divErrorMessage.style.display = 'inline-block';
                        $('#errorMessage').html(response.message);
                    }
                    $('#empty-state').hide();
                    $('#content-state').show();
                    $('#submit-button')
                        .text(createContent)
                        .prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    $('#empty-state-text')
                        .text(generalError);

                    $('#submit-button')
                        .text(createContent)
                        .prop('disabled', false);
                }
            });

        }
    });
});
