// import Core from './core';

// $(() => {
//     $('#questions').select2({
//         placeholder: 'Please select question',
//         allowClear: true
//     });

//     const removeText = $('#remove_text').val();
//     const copyText = $('#copy_text').val();
//     const shortCodeText = $('#short_code').val();
//     const $quesElement = $('#questions');

//     var questionsList = JSON.parse($('#questions_list').val());
//     const $sortableUl = $('#sortable');
//     $sortableUl.sortable();

//     $('#btn_new_question').on('click', function (e) {
//         document.querySelector('#frm_new_question').reset();
//         $quesElement.val(null).trigger('change');
//         $('#options').val(null).trigger('change');
//         $('#newQuestionModal').modal('show');
//     });

//     $('#btn-confirm-add-question').click(function () {
//         // alert("ininin");
//         var formData = $('#frm_new_question').serialize();
//         var selectedQuestions =$quesElement.val();
//         $.ajax({
//             type: 'POST',
//             url: $('#new_question_url').val(),
//             data: formData, success: function (response) {
//                 Core.toastSuccess(response.message);
//                 var option = '<option value="' + response.question[0] + '">' + response.question[1] + '</option>';
//                 $quesElement.append(option);

//                 selectedQuestions.push(response.question[0]);
//                 $quesElement.val(selectedQuestions).trigger('change');

//                 questionsList = response.questions;
//             }, error: function (xhr, status, error) {
//                 const res = JSON.parse(xhr.responseText);
//                 Core.toastError(res.message);
//             }
//         });
//     });


//     $(document).on('click', '#add-question', function (event) {
//         let params = '';
//         let questions =$quesElement.val();
//         questions.forEach(i => {
//             Object.entries(questionsList).forEach(([key, value]) => {
//                 if (key === i) {
//                     params += '<li class="bg-default mb-2 ui-state-highlight ui-sortable-handle question-row" id="' + `${key}` + '">' +
//                         '<span class="handle">' +
//                         ' <i class="fas fa-ellipsis-v"></i>' +
//                         ' <i class="fas fa-ellipsis-v"></i>' +
//                         '</span>' +
//                         '<span class="text">' + `${value}` + '</span>' +
//                         '<div class="float-right">' +
//                         '<small>' + shortCodeText + '</small> ' +
//                         '<small>[Q_' + `${key}` + ']</small> ' +
//                         '<button class="btn btn-xs btn-success copy-question-code" data-code-id="[Q_' + `${key}` + ']">' + copyText + '</button> ' +
//                         '<button class="btn btn-xs btn-danger remove-question"   data-form-id="' + `${key}` + '">' + removeText + '</button>' +
//                         '</div>' +
//                         '</li>';
//                 }
//             });
//         });
//         $('#newQuestionModal').modal('hide');
//         $sortableUl.append(params);
//     });

//     // Remove question button
//     $(document).on('click', '.remove-question', function () {
//         var questionRow = $(this).closest('.question-row');
//         questionRow.remove();
//     });


//     $(document).on('click', '.copy-question-code', function (e) {
//         e.preventDefault();
//         const code = $(this).data('code-id');
//         var ClipboardHelper = {
//             copyText: function (text) {
//                 var $tempInput = $('<textarea>');
//                 $('body').append($tempInput);
//                 $tempInput.val(text).select();
//                 document.execCommand('copy');
//                 $tempInput.remove();
//             }
//         };

//         ClipboardHelper.copyText(code);
//     });

//     //prepare questions before submit
//     $('#btn_submit_prompt').click(function (e) {
//         e.preventDefault();
//         let params = [];
//         $.map($sortableUl.find('li'), function (el) {
//             params.push(el.id);
//         });

//         $('#prompt_questions').val(JSON.stringify(params));
//         document.getElementById('frm_submit_prompt').submit();
//     });
// });




// import Core from './core';

// $(document).ready(function () {
//     $('#questions').select2({
//         placeholder: 'Please select question',
//         allowClear: true
//     });

//     const removeText = $('#remove_text').val();
//     const copyText = $('#copy_text').val();
//     const shortCodeText = $('#short_code').val();
//     const $quesElement = $('#questions');

//     let questionsList = JSON.parse($('#questions_list').val());
//     const $sortableUl = $('#sortable');
//     $sortableUl.sortable();

//     $('#btn_new_question').on('click', function (e) {
//         $('#frm_new_question')[0].reset();
//         $quesElement.val(null).trigger('change');
//         $('#options').val(null).trigger('change');
//         $('#newQuestionModal').modal('show');
//     });

//     $('#btn-confirm-add-question').click(function () {
//         alert("inin");
//         const formData = $('#frm_new_question').serialize();
//         const selectedQuestions = $quesElement.val();
//         $.ajax({
//             type: 'POST',
//             url: $('#new_question_url').val(),
//             data: formData,
//             success: function (response) {
//                 console.log(response);
//                 Core.toastSuccess(response.message);
//                 console.log(response.message);
//                 const option = '<option value="' + response.question[0] + '">' + response.question[1] + '</option>';
//                 $quesElement.append(option);
//                 console.log(option);

//                 selectedQuestions.push(response.question[0]);
//                 $quesElement.val(selectedQuestions).trigger('change');

//                 questionsList = response.questions;
//             },
//             error: function (xhr, status, error) {
//                 const res = JSON.parse(xhr.responseText);
//                 Core.toastError(res.message);
//             }
//         });
//     });

//     $(document).on('click', '#add-question', function (event) {
//         let params = '';
//         const questions = $quesElement.val();
//         questions.forEach(i => {
//             Object.entries(questionsList).forEach(([key, value]) => {
//                 if (key === i) {
//                     // params += '<li class="bg-default mb-2 ui-state-highlight ui-sortable-handle question-row" id="' + key + '">' +
//                     //     '<span class="handle">' +
//                     //     ' <i class="fas fa-ellipsis-v"></i>' +
//                     //     ' <i class="fas fa-ellipsis-v"></i>' +
//                     //     '</span>' +
//                     //     '<span class="text">' + value + '</span>' +
//                     //     '<div class="float-right">' +
//                     //     '<small>' + shortCodeText + '</small> ' +
//                     //     '<small>[Q_' + key + ']</small> ' +
//                     //     '<button class="btn btn-xs btn-success copy-question-code" data-code-id="[Q_' + key + ']">' + copyText + '</button> ' +
//                     //     '<button class="btn btn-xs btn-danger remove-question" data-form-id="' + key + '">' + removeText + '</button>' +
//                     //     '</div>' +
//                     //     '</li>';


//                     params += '<li class="list-group-item bg-light mb-2 question-row d-flex justify-content-between align-items-center" id="' + key + '">' +
//                         '<span class="handle">' +
//                         ' <i class="fas fa-ellipsis-v"></i>' +
//                         ' <i class="fas fa-ellipsis-v"></i>' +
//                         '</span>' +
//                         '<span class="text">' + value + '</span>' +
//                         '<div class="btn-group">' +
//                         '<div class="d-flex align-items-center">'+
//                         '<small class="text-muted me-2">' + shortCodeText + '</small> ' +
//                         '<small class="text-muted me-2">[Q_' + key + ']</small> ' +
//                         '</div>' +
//                         '<button class="btn btn-outline-success btn-sm copy-question-code"  data-code-id="[Q_' + key + ']">' + copyText + '</button> ' +
//                         '<button class="btn btn-outline-danger btn-sm remove-question"  data-form-id="' + key + '">' + removeText + '</button>' +
//                         '</div>' +
//                         '</li>';


//                 }
//             });
//         });
//         $('#newQuestionModal').modal('hide');
//         $sortableUl.append(params);
//     });

//     // Remove question button
//     $(document).on('click', '.remove-question', function () {
//         $(this).closest('.question-row').remove();
//     });

//     $(document).on('click', '.copy-question-code', function (e) {
//         e.preventDefault();
//         const code = $(this).data('code-id');
//         const ClipboardHelper = {
//             copyText: function (text) {
//                 const $tempInput = $('<textarea>');
//                 $('body').append($tempInput);
//                 $tempInput.val(text).select();
//                 document.execCommand('copy');
//                 $tempInput.remove();
//             }
//         };

//         ClipboardHelper.copyText(code);
//     });

//     // Prepare questions before submit
//     $('#btn_submit_prompt').click(function (e) {
//         e.preventDefault();
//         const params = [];
//         $sortableUl.find('li').each(function () {
//             params.push($(this).attr('id'));
//         });

//         $('#prompt_questions').val(JSON.stringify(params));
//         $('#frm_submit_prompt').submit();
//     });
// });
// window.global = window;



import Core from './core';

$(document).ready(function () {
    // $('#questions').select2({
    //     placeholder: 'Please select question',
    //     allowClear: true,
    // });

    const removeText = $('#remove_text').val();
    const copyText = $('#copy_text').val();
    const shortCodeText = $('#short_code').val();
    const $quesElement = $('#questions');

    let questionsList = JSON.parse($('#questions_list').val());
    const $sortableUl = $('#sortable');
    $sortableUl.sortable();

    $('#btn_new_question').on('click', function (e) {
        $('#frm_new_question')[0].reset();
        $quesElement.val(null).trigger('change');
        $('#options').val(null).trigger('change');
        $('#newQuestionModal').modal('show');
    });

    // Use event delegation for dynamically added elements
    $(document).on('click', '#btn-confirm-add-question', function () {
        alert("inin"); // This should show the alert
        console.log("Button clicked!"); // Debugging statement

        const formData = $('#frm_new_question').serialize();
        console.log($('#frm_new_question').serializeArray());
        const selectedQuestions = $quesElement.val();
        $.ajax({
            type: 'POST',
            url: $('#new_question_url').val(),
            data: formData,
            success: function (response) {
                console.log(response);
                // $('.toast').text(response.message);
                // display: flex;
                // Core.toastSuccess(response.message);
                // Show the toast by adding display:flex
                $('.toast').addClass('showNewDiv');

                // Set timeout to hide the toast after 5 seconds
                setTimeout(function() {
                    $('.toast').removeClass('showNewDiv'); // Hide the toast by removing the 'show' class
                }, 5000);
                console.log(response.message);
                const option = '<option value="' + response.question[0] + '">' + response.question[1] + '</option>';
                $quesElement.append(option);
                console.log(option);

                selectedQuestions.push(response.question[0]);
                $quesElement.val(selectedQuestions).trigger('change');

                questionsList = response.questions;
            },
            error: function (xhr, status, error) {
                const res = JSON.parse(xhr.responseText);
                // Core.toastError(res.message);
            }
        });
    });

    $(document).on('click', '#add-question', function (event) {
        let params = '';
        const questions = $quesElement.val();
        questions.forEach(i => {
            Object.entries(questionsList).forEach(([key, value]) => {
                if (key === i) {
                    params += '<li class="list-group-item bg-light mb-2 question-row d-flex justify-content-between align-items-center" id="' + key + '">' +
                        '<span class="handle">' +
                        ' <i class="fas fa-ellipsis-v"></i>' +
                        ' <i class="fas fa-ellipsis-v"></i>' +
                        '</span>' +
                        '<span class="text">' + value + '</span>' +
                        '<div class="btn-group">' +
                        '<div class="d-flex align-items-center">'+
                        '<small class="text-muted me-2">' + shortCodeText + '</small> ' +
                        '<small class="text-muted me-2">[Q_' + key + ']</small> ' +
                        '</div>' +
                        '<button class="btn btn-outline-success btn-sm copy-question-code"  data-code-id="[Q_' + key + ']">' + copyText + '</button> ' +
                        '<button class="btn btn-outline-danger btn-sm remove-question"  data-form-id="' + key + '">' + removeText + '</button>' +
                        '</div>' +
                        '</li>';
                }
            });
        });
        $('#newQuestionModal').modal('hide');
        $sortableUl.append(params);
    });

    // Remove question button
    $(document).on('click', '.remove-question', function () {
        $(this).closest('.question-row').remove();
    });

    $(document).on('click', '.copy-question-code', function (e) {
        e.preventDefault();
        const code = $(this).data('code-id');
        const ClipboardHelper = {
            copyText: function (text) {
                const $tempInput = $('<textarea>');
                $('body').append($tempInput);
                $tempInput.val(text).select();
                document.execCommand('copy');
                $tempInput.remove();
            }
        };

        ClipboardHelper.copyText(code);
    });

    // Prepare questions before submit
    $('#btn_submit_prompt').click(function (e) {
        e.preventDefault();
        const params = [];
        $sortableUl.find('li').each(function () {
            params.push($(this).attr('id'));
        });

        $('#prompt_questions').val(JSON.stringify(params));
        $('#frm_submit_prompt').submit();
    });
});



