@extends('layouts.users.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg12">

                <div class="chat-section">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- QUESTION -->
                            <div class="content-top">
                                <p class="content-pra">{{ $original_question }}</p>
                            </div>
                            <!-- ANSWER -->
                            <div class="content-top">
                                <p id="ai-response" class="content-pra"></p>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="row">
                        <div class="col-lg-8"><div class="input-section">
                            <input type="text" class="start-conversation" placeholder="Start a Conversation">
                            <i class="fa-solid fa-paper-plane mail-icon"></i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="chat-right-section">
                            <img src="{{ asset('users-images/Line 2.png') }}" alt="">
                            <p class="chat-right-heading">Cardano GPT can make mistakes, including about people, so double-check its responses</p>
                        </div>
                    </div> -->

                    <div id="dynamic-conversations" class="row">
                        <div class="col-lg-8">
                            <div class="input-section">
                                <input type="text" id="start-conversation" class="start-conversation" placeholder="Start a Conversation">
                                <i class="fa-solid fa-paper-plane mail-icon" id="send-button"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="chat-right-section">
                                <img src="{{ asset('users-images/Line 2.png') }}" alt="">
                                <p class="chat-right-heading">Cardano GPT can make mistakes, including about people, so double-check its responses</p>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
        const inputField = document.getElementById('start-conversation');
        const userInput = inputField.value.trim();

        if (userInput === '') return;

        // Clear the input field
        inputField.value = '';

        // Append the user's input to the conversation container
        const conversationContainer = document.getElementById('dynamic-conversations');
        const userQuestionDiv = document.createElement('div');
        userQuestionDiv.classList.add('content-top');
        userQuestionDiv.innerHTML = `<p class="content-pra">${userInput}</p>`;
        conversationContainer.appendChild(userQuestionDiv);

        // Placeholder for the AI response
        const aiResponseDiv = document.createElement('div');
        aiResponseDiv.classList.add('content-top');
        const responsePara = document.createElement('p');
        responsePara.classList.add('content-pra');
        responsePara.textContent = 'Generating response...';
        aiResponseDiv.appendChild(responsePara);
        conversationContainer.appendChild(aiResponseDiv);

        // Make an AJAX call to get the AI response
        fetch('/your-api-endpoint', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ question: userInput })
        })
        .then(response => response.json())
        .then(data => {
            // Update the response text with the actual AI response
            responsePara.textContent = data.response;
        })
        .catch(error => {
            responsePara.textContent = 'Error generating response. Please try again.';
            console.error('Error:', error);
        });
    });

</script>

@endsection('content')