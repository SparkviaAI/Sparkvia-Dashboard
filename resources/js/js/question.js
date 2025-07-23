// $(() => {
//     const select = document.querySelector('#question_type');
//     const minimumAnswerLengthInput = document.querySelector('#minimum_answer_length_group');
//     const optionsInput = document.querySelector('#options_group');

//     function toggleHiddenInput() {
//         if (select.value === 'single_select') {
//             optionsInput.style.display = 'block';
//             minimumAnswerLengthInput.style.display = 'none';
//         } else {
//             optionsInput.style.display = 'none';
//             minimumAnswerLengthInput.style.display = 'inline-block';
//         }
//     }

//     toggleHiddenInput();
//     select.addEventListener('change', () => {
//         toggleHiddenInput();
//     });
// });
