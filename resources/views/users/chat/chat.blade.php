@extends('layouts.users.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-section">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- QUESTION -->
                            <div class="content-top nSpCls">
                                <span>
                                    <img src="{{ Illuminate\Support\Facades\Auth::guard('user')->user()->profile_image ? asset('f_user/'.Illuminate\Support\Facades\Auth::guard('user')->user()->profile_image) : asset('users-images/defaultimage.jpg') }}" alt="Profile picture" class="pro-pic" id="pro-pic">
                                </span>
                                <p class="content-pra">{{ $original_question }}</p>
                            </div>
                            <!-- ANSWER -->
                            <div class="content-top nSpCls">
                                <img src="{{ asset('users-images/cardano_favicon.png') }}" alt="Profile picture" class="pro-pic" id="pro-pic">
                                <p id="ai-response" class="content-pra"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Container for dynamic inputs and responses -->
                    <div id="dynamic-conversations" class="row">
                        <div class="col-lg-8 newClassOne">
                            <div class="input-section">
                                <input type="text" id="start-conversation" class="start-conversation" placeholder="Start a Conversation">
                                <i class="fa-solid fa-paper-plane mail-icon" id="send-button"></i>
                            </div>
                        </div>
                        <div class="col-lg-3 newClassTwo">
                            <div class="chat-right-section">
                                <img src="{{ asset('users-images/Line 2.png') }}" alt="">
                                <p class="chat-right-heading">Cardano GPT can make mistakes, including about people, so double-check its responses</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden input to store user ID -->
                    <input type="hidden" id="user-id" name="userId" value="{{ Illuminate\Support\Facades\Auth::guard('user')->user()->id }}">

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('.loader-overlay').css('display', 'flex');
    document.addEventListener('DOMContentLoaded', function() {
        $('.loader-overlay').fadeOut('slow', function() {
            $(this).css('display', 'none');
        });
        let content = @json($content).replace(/\n/g, '<br>');
        let aiResponseElement = document.getElementById('ai-response');

        let words = content.split(' ');
        let index = 0;

        function appendWord() {
            if (index < words.length) {
                aiResponseElement.innerHTML += words[index] + ' ';
                index++;
                setTimeout(appendWord, 100); // Adjust the timeout for the desired speed
            }
        }
        appendWord();
    });



    document.getElementById('send-button').addEventListener('click', function() {
        $('.loader-overlay').css('display', 'flex');

        const inputField = document.getElementById('start-conversation');
        const userInput = inputField.value.trim();
        const userId = document.getElementById('user-id').value;

        if (userInput === ''){
            $('.loader-overlay').fadeOut('slow', function() {
                $(this).css('display', 'none');
            });
            return;
        } 

        // Clear the input field
        inputField.value = '';

        // Append the user's input to the conversation container
        const conversationContainer = document.getElementById('dynamic-conversations');

        // Create new divs with classes "row" and "col-lg-8"
        const rowDiv = document.createElement('div');
        rowDiv.classList.add('row');
        const colDiv = document.createElement('div');
        colDiv.classList.add('col-lg-8');

        // Append user question to colDiv
        // const userQuestionDiv = document.createElement('div');
        // userQuestionDiv.classList.add('content-top');
        // userQuestionDiv.classList.add('nSpCls');
        // userQuestionDiv.innerHTML = `<p class="content-pra">${userInput}</p>`;
        // colDiv.appendChild(userQuestionDiv);
        /////////////////// NEW CODE STARTS  //////////////////////
        const userQuestionDiv = document.createElement('div');
        userQuestionDiv.classList.add('content-top', 'nSpCls');
        // Create the span for the profile image
        const profileImageSpan = document.createElement('span');
        profileImageSpan.innerHTML = `
            <img src="{{ Illuminate\Support\Facades\Auth::guard('user')->user()->profile_image ? asset('f_user/'.Illuminate\Support\Facades\Auth::guard('user')->user()->profile_image) : asset('users-images/defaultimage.jpg') }}" alt="Profile picture" class="pro-pic" id="pro-pic">
        `;
        // Create the p element for the user input
        const userInputParagraph = document.createElement('p');
        userInputParagraph.classList.add('content-pra');
        userInputParagraph.innerHTML = userInput;
        // Append the span and p elements to the user question div
        userQuestionDiv.appendChild(profileImageSpan);
        userQuestionDiv.appendChild(userInputParagraph);
        // Append the user question div to the colDiv
        colDiv.appendChild(userQuestionDiv);
        ///////////////////// NEW CODE ENDS ///////////////////////////


        // Placeholder for the AI response
        // const aiResponseDiv = document.createElement('div');
        // aiResponseDiv.classList.add('content-top');
        // userQuestionDiv.classList.add('nSpCls');
        // const responsePara = document.createElement('p');
        // responsePara.classList.add('content-pra');
        // // responsePara.textContent = 'Generating response...';
        // aiResponseDiv.appendChild(responsePara);
        // colDiv.appendChild(aiResponseDiv);
        ///////////////////// NEW CODE STARTS //////////////////////////
        // Create the div for the AI response
        const aiResponseDiv = document.createElement('div');
        aiResponseDiv.classList.add('content-top', 'nSpCls');

        // Create the img element for the profile picture
        const profileImage = document.createElement('img');
        profileImage.src = "{{ asset('users-images/cardano_favicon.png') }}";
        profileImage.alt = "Profile picture";
        profileImage.classList.add('pro-pic');
        profileImage.id = "pro-pic";
        // Create the p element for the AI response
        const responsePara = document.createElement('p');
        responsePara.id = "ai-response";
        responsePara.classList.add('content-pra');
        // Append the img and p elements to the AI response div
        aiResponseDiv.appendChild(profileImage);
        aiResponseDiv.appendChild(responsePara);
        // Append the AI response div to the colDiv
        colDiv.appendChild(aiResponseDiv);
        ///////////////////// NEW CODE ENDS /////////////////////////

        // Append colDiv to rowDiv and rowDiv to the conversation container
        rowDiv.appendChild(colDiv);
        conversationContainer.appendChild(rowDiv);

        // Move the input field to the bottom
        conversationContainer.appendChild(document.querySelector('.newClassOne'));
        conversationContainer.appendChild(document.querySelector('.newClassTwo'));

        // Make an AJAX call to get the AI response
        fetch('/chat-update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ question: userInput, userId: userId })
        })
        .then(response => response.json())
        .then(data => {

            $('.loader-overlay').fadeOut('slow', function() {
                $(this).css('display', 'none');
            });

            console.log(data.response);
            let contents = data.response.replace(/\n/g, '<br>');
            let words = contents.split(' ');
            let index = 0;
            function appendWord() {
                if (index < words.length) {
                    responsePara.innerHTML += words[index] + ' ';
                    index++;
                    setTimeout(appendWord, 100); // Adjust the timeout for the desired speed
                }
            }
            appendWord();
        })
        .catch(error => {
            responsePara.innerHTML = 'Error generating response. Please try again.';
            console.error('Error:', error);
        });
    });



    // document.getElementById('send-button').addEventListener('click', function() {
    //     const inputField = document.getElementById('start-conversation');
    //     const userInput = inputField.value.trim();
    //     const userId = document.getElementById('user-id').value;

    //     if (userInput === '') return;

    //     // Clear the input field
    //     inputField.value = '';

    //     // Append the user's input to the conversation container
    //     const conversationContainer = document.getElementById('dynamic-conversations');
    //     const userQuestionDiv = document.createElement('div');
    //     userQuestionDiv.classList.add('content-top');
    //     userQuestionDiv.innerHTML = `<p class="content-pra">${userInput}</p>`;
    //     conversationContainer.appendChild(userQuestionDiv);

    //     // Placeholder for the AI response
    //     const aiResponseDiv = document.createElement('div');
    //     aiResponseDiv.classList.add('content-top');
    //     const responsePara = document.createElement('p');
    //     responsePara.classList.add('content-pra');
    //     responsePara.textContent = 'Generating response...';
    //     aiResponseDiv.appendChild(responsePara);
    //     conversationContainer.appendChild(aiResponseDiv);

    //     // Move the input field to the bottom
    //     conversationContainer.appendChild(document.querySelector('.newClassOne'));
    //     conversationContainer.appendChild(document.querySelector('.newClassTwo'));

    //     // Make an AJAX call to get the AI response
    //     fetch('/chat-update', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: JSON.stringify({ question: userInput, userId: userId })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log(data.response);
    //         let contents = data.response.replace(/\n/g, '<br>');
    //         let words = contents.split(' ');
    //         let index = 0;
    //         function appendWord() {
    //             if (index < words.length) {
    //                 responsePara.innerHTML += words[index] + ' ';
    //                 index++;
    //                 setTimeout(appendWord, 100); // Adjust the timeout for the desired speed
    //             }
    //         }
    //         appendWord();
    //     })
    //     .catch(error => {
    //         responsePara.innerHTML = 'Error generating response. Please try again.';
    //         console.error('Error:', error);
    //     });
    // });



    // document.getElementById('send-button').addEventListener('click', function() {
    //     const inputField = document.getElementById('start-conversation');
    //     const userInput = inputField.value.trim();
    //     const userId = document.getElementById('user-id').value;

    //     if (userInput === '') return;

    //     // Clear the input field
    //     inputField.value = '';

    //     // Append the user's input to the conversation container
    //     const conversationContainer = document.getElementById('dynamic-conversations');
    //     const userQuestionDiv = document.createElement('div');
    //     userQuestionDiv.classList.add('content-top');
    //     userQuestionDiv.innerHTML = `<p class="content-pra">${userInput}</p>`;
    //     conversationContainer.insertBefore(userQuestionDiv, conversationContainer.firstChild);

    //     // Placeholder for the AI response
    //     const aiResponseDiv = document.createElement('div');
    //     aiResponseDiv.classList.add('content-top');
    //     const responsePara = document.createElement('p');
    //     responsePara.classList.add('content-pra');
    //     responsePara.textContent = 'Generating response...';
    //     aiResponseDiv.appendChild(responsePara);
    //     conversationContainer.insertBefore(aiResponseDiv, conversationContainer.firstChild);

    //     // Move the input field to the bottom
    //     conversationContainer.appendChild(document.querySelector('.input-section'));

    //     // Make an AJAX call to get the AI response
    //     fetch('/chat-update', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: JSON.stringify({ question: userInput, userId: userId })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log(data.response);
    //             let contents = data.response.replace(/\n/g, '<br>'); // No need to JSON.parse
    //             let words = contents.split(' ');
    //             let index = 0;
    //             function appendWord() {
    //                 if (index < words.length) {
    //                     responsePara.innerHTML += words[index] + ' ';
    //                     index++;
    //                     setTimeout(appendWord, 100); // Adjust the timeout for the desired speed
    //                 }
    //             }
    //             appendWord();
    //     })
    //     .catch(error => {
    //         responsePara.innerHTML = 'Error generating response. Please try again.';
    //         console.error('Error:', error);
    //     });
    // });
</script>
@endsection
