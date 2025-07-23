@extends('layouts.users.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-top">
                    <h1 class="content-hed" style="color: #00A234;">Hello, <span>{{ substr($getUserDetails->name, 0, 8) }}. </span>Let's Chat</h1>
                    <p class="content-pra">Ask our GPT anything from history, technology, science, politics, and lots more. </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="chat-section">
                    <h3 class="chat-hed pb-3">Start your conversation</h3>
                    <form id="createChat" method="POST" action="{{ route('chat.store') }}">
                    @csrf
                        <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="input-section">
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
                    <div class="row giveSpaceCls">
                        <div class="col-lg-8">
                            <p class="chat-hed">Sample Conversations</p>
                        </div>
                    </div>
                    <div class="row giveSpaceCls">
                        <div class="col-lg-8 otherChat">
                            <!-- suggestion 1 -->
                            <form id="createChat" method="POST" action="{{ route('chat.store') }}">
                            @csrf
                                <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                                <input type="hidden" name="chat_question" id="chatQuestion" value="How long does it take to walk to moon">
                                <button class="btn btn-success newBtnClss" type="submit">How long does it take to walk to moon</button>
                            </form>

                            <!-- suggestion 2 -->
                            <form id="createChat" method="POST" action="{{ route('chat.store') }}">
                            @csrf
                                <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                                <input type="hidden" name="chat_question" id="chatQuestion" value="Recommend the latest trends">
                                <button class="btn btn-success newBtnClss" type="submit">Recommend the latest trends</button>
                            </form>

                            <!-- suggestion 3 -->
                            <form id="createChat" method="POST" action="{{ route('chat.store') }}">
                            @csrf
                                <input type="hidden" name="userId" value="{{ $getUserDetails->id }}">
                                <input type="hidden" name="chat_question" id="chatQuestion" value="What is food?">
                                <button class="btn btn-success newBtnClss" type="submit">What is food?</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEW PREVIOUS CHAT SECTION STARTS -->
        <div class="row refreshBody">
            <div class="col-lg-12">
                <div class="chat-section">
                    <div class="otherChat">
                        <h3 class="chat-hed pb-3">Previous conversation</h3>
                        @if(empty($getAllMessages))
                            <p style="opacity:0.3; color:red;" class="chat-hed">Clear Conversations <span><i class="fa-solid fa-trash"></i></span></p> 
                        @else
                            <p style="cursor:pointer; color:red;" class="chat-hed" onclick="deleteConversation({{ $getUserDetails->id }})">Clear Conversations <span><i class="fa-solid fa-trash"></i></span></p>
                        @endif 
                    </div>

                    <!-- PREVIOUS CHAT FROM DB STARTS -->
                    <div class="row">
                    <!-- LOOP STARTS -->
                        @if(!empty($getAllMessages))
                            @foreach($getAllMessages as $message)
                            <div class="col-lg-4 tool-boxes">
                                <div class="tool-write otherChat">
                                    <p class="web-subhed" style="margin-bottom: 0px !important;">
                                        {{ 
                                            strlen($message->content) > 260 ? substr($message->content, 0, 260) . '...' : $message->content;
                                        }}
                                    </p>
                                    <div class="aTagCls dropdown d-inline">
                                        <a href="#" class="dropdown-toggle remCls" id="dropdownMenuLink{{ $message->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-v"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $message->id }}">
                                            <form method="POST" action="{{ route('chat.delete.single',$message->id) }}">
                                            @csrf
                                                <li>
                                                    <a href="{{ route('chat.delete.single',$message->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Delete
                                                    </a>
                                                </li>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    <!-- LOOP ENDS -->
                    </div>
                    <!-- PREVIOUS CHAT FROM DB ENDS -->

                </div>
            </div>
        </div>

        <!-- NEW PREVIOUS CHAT SECTION ENDS -->
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

    function deleteConversation(userId){
        var userId = userId;
        Swal.fire({
            title: 'Are you sure you want to delete all previous conversations?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "{{ route('chat.delete.all') }}",
                    datatype: 'json',
                    method: 'post',
                    data: {
                        userId: userId
                    },
                    success: function() {
                        $(".refreshBody").load(location.href + " .refreshBody");
                        Swal.fire("Done!", "Converstaions succesfully deleted!", "success");
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });

            } else if (result.isDenied) {
                Swal.fire("Error deleting!", "Please try again", "error")
            }
        })
    }

</script>

@endsection('content')