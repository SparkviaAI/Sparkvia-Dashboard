@extends('layouts.users.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="content-top">
                    <!-- <h1 class="content-hed" style="color: #00A234;">Hello, <span>{{ substr($getUserDetails->name, 0, 8) }}</span>👋</h1>
                    <h1 class="content-hed">How can i help?</h1> -->
                    <p class="content-pra">Welcome to Sparkvia AI. Start creating amazing contents. </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tool-library">
                    <div class="tool-content">
                        <p class="tool-hed1">Tool Library</p>
                        <!-- <a href="{{ route('tools.index',1) }}"> -->
                            <p class="tool-hed2">
                                <!-- Go To Tools  <i class="fa-solid fa-arrow-right"></i>  -->
                            </p>
                        <!-- </a> -->
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">

            @foreach($getThreeRandomPrompts as $prompt)
                <div class="col-lg-4 tool-boxes">
                    <div class="tool-write">
                        <button class="website-tool">
                            <!-- <img class="website-icon" src="{{ asset('users-images/globe.png') }}" alt=""> -->
                            {{ $prompt->category->title }}</button>
                        <p class="web-hed">{{ $prompt->title }}</p>
                        <p class="web-subhed">{{ $prompt->description }}</p>
                        <a href="{{ route('tools.prompt.index',$prompt->id) }}">
                            <p class="tool-hed2">Try Now  <i class="fa-solid fa-arrow-right"></i> </p>
                        </a>
                    </div>
                </div>
            @endforeach
            
        </div>

        <!-- REMOVE THE SECTION ON 9 JULY, 2025 STARTS -->
        <!-- <div class="row">
            <div class="col-lg12">
                <div class="chat-section">
                    <h3 class="chat-hed pb-3">Chat with CardanoGPT </h3>
                    <p class="chat-hed">Ask our GPT anything from history, technology, science, politics and lots more.</p> 
                    <p class="chat-hed pb-5">Enter your prompts and start getting responses today.</p>
                    <form id="createChat" method="POST" action="{{ route('chat.store') }}">
                    @csrf
                        <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                        <div class="row">
                            <div class="col-lg-8"><div class="input-section">
                                <input type="text" name="chat_question" class="start-conversation" id="chatQuestion" placeholder="Start a Conversation">
                                <i class="fa-solid fa-paper-plane mail-icon" id="submitIcon"></i>
                                <input type="submit" id="submitButton" style="display: none;">
                                <div id="errorMessage" style="color: red; display: none;">Please enter something.</div>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-3">
                        <div class="chat-right-section">
                            <img src="{{ asset('users-images/Line 2.png') }}" alt="">
                            <p class="chat-right-heading">Cardano GPT can make mistakes, including about people, so double-check its responses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- REMOVE THE SECTION ON 9 JULY, 2025 ENDS -->

    </div>
</section>

<script>
     $(".newBtnClss").click(function() {
        $('.loader-overlay').css('display', 'flex');
    });

    document.getElementById('submitIcon').addEventListener('click', function() {
        const chatQuestion = document.getElementById('chatQuestion').value.trim();
        const errorMessage = document.getElementById('errorMessage');
        
        if (chatQuestion === '') {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            $('.loader-overlay').css('display', 'flex');
            document.getElementById('submitButton').click();
        }
    });
</script>
@endsection('content')