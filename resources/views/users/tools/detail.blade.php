@extends('layouts.users.app')
@section('content')

<style>
.emptyClsDesign{
    display: flex;
    position: relative;
    justify-content: center !important;
    text-align: center !important;
}

.newPromptContentField{
    padding: 36% 0;
}

.DDivCls{
    border: solid 3px;
    border-radius: 6.11px;
    margin-left: 3px;
}

.copy-btn{
    cursor: pointer;
}

.download-btn{
    cursor: pointer;
    text-decoration: none;
    color: black;
    font-weight: bold;
    padding-right: 9px;
}

.download-btn:hover{
    text-decoration: none;
    color: black;
    font-weight: bold;
    padding-right: 9px;
}
.play-btn{
    cursor: pointer;
    text-decoration: none;
    color: black;
    font-weight: bold;
    padding-right: 9px;
}

.play-btn:hover{
    text-decoration: none;
    color: black;
    font-weight: bold;
    padding-right: 9px;
}

.disAbCls{
    pointer-events: none;
    opacity: 0.2;
}

/* Blur background for modal */
.modal-backdrop {
  backdrop-filter: blur(8px);
}

/* Modal content styling */
.modal-content {
  border-radius: 15px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  padding: 30px;
  max-width: 360px;
  margin: 0 auto;
  background-color: #fff;
}

/* Center icon in modal */
.icon-container {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 70px;
  height: 70px;
  margin: 0 auto;
}

/* Coin icon styling */
.coin-icon {
  width: 50px;
  height: 50px;
  z-index: 1; /* Ensure the coin appears behind the error icon */
}

/* Error icon styling */
.error-icon {
  position: absolute;
  top: -5px;
  right: -5px;
  width: 40px;
  height: 40px;
  z-index: 2; /* Ensure the error icon appears in front of the coin */
}

/* Modal title */
.modal-title {
  font-weight: bold;
  color: #444;
  margin-top: 10px;
}

/* Modal text */
.modal-text {
  color: #777;
  font-size: 14px;
  margin-top: 10px;
  margin-bottom: 20px;
}

/* Custom button */
.btn-suc {
  background-color: #49DF28;
  border-color: #28a745;
  padding: 10px 20px;
  font-size: 14px;
  color: #fff;
  border-radius: 5px;
  width: 100%; /* Make the button span the full width */
}

.btn-suc:hover {
  color: #fff;
  background-color: #49DF28;
  border-color: #218838;
}

.is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875em;
}

/* Audio player styles */
#generated-audio {
    display: none; /* Hide the native audio controls */
}

#play-pause-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    color: black;
    font-weight: bold;
}

#play-pause-btn:hover {
    text-decoration: none;
    color: black;
}

</style>
<section class="dasboard-all pages pt-4 pb-4">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="back-btn">
                    <a href="{{ route('tools.index',$getPromptDetails->category->id) }}">
                        <p class="go-back"><i class="fa-solid fa-arrow-left"></i> Go Back</p>
                    </a>
                </div>
            </div>
        </div>
        <form id="createContent">
            @csrf
            <input type="hidden" name="prompt_id" value="{{ $getPromptDetails->id }}">
            <input type="hidden" name="prompt_type" value="{{ $getPromptDetails->type }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="button-container1">
                        <div class="title">{{ $getPromptDetails->title }}</div>
                    </div>
                    <!-- {{ $getPromptDetails->questions }} -->
                    <!-- NEW CODE WITH DYNAMIC QUESTIONS START -->
                        <div class="prompt-field">
                            <h2 class="prompt-title">Prompt field</h2>
                            <p class="prompt-subtitle">Fill the prompt field to generate content</p>
                            @foreach($getPromptDetails->questions as $question)
                                <div class="mb-3">
                                    <label class="form-label"
                                            {{ $question->question }}
                                            for="{{ "question_$question->id" }}">{{ $question->question }} <span
                                            class="form-label-secondary">{{ $question->is_required == 'required' ? '' : '(Optional)' }}</span></label>
                                    @if($question->type ==  App\Models\Question::SINGLE_LINE || $question->type ==  App\Models\Question::LIVE_CRAWLING)
                                        <input name="{{ "question_$question->id" }}"
                                                minlength="{{ $question->minimum_answer_length }}" type="text"
                                                class="form-control {{ $errors->has($question->id) ? 'is-invalid' : '' }}"
                                                id="{{ "question_$question->id" }}" placeholder=""
                                                value="{{ old($question->id, '') }}" {{ $question->is_required == 'required' ? "required" : "" }}>
                                    @elseif($question->type ==  App\Models\Question::MULTI_LINE)
                                        <textarea name="{{ "question_$question->id" }}"
                                                    minlength="{{ $question->minimum_answer_length }}"
                                                    style="overflow:auto;resize:none" rows="3"
                                                    class="form-control {{ $errors->has($question->id) ? 'is-invalid' : '' }}"
                                                    placeholder=""
                                                    id="{{ "question_$question->id" }}" {{ $question->is_required == 'required' ? "required" : "" }}>{{ old($question->id, '') }}</textarea>

                                    @elseif($question->type == App\Models\Question::SINGLE_SELECT)
                                        <select
                                            name="{{ "question_$question->id" }}"
                                            class="form-select {{ $errors->has($question->id) ? 'is-invalid' : '' }}" {{ $question->is_required == 'required' ? "required" : "" }}>
                                            <option>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach($question->options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>

                                    @endif
                                    <span class="invalid-feedback">{{ $errors->first($question->id) }}</span>
                                </div>
                            @endforeach
                        </div>
                    <!-- NEW CODE WITH DYNAMIC QUESTIONS START -->

                    <!-- OLD CODE FOR STATIC QUESTIONS STARTS -->
                        <!-- <div class="prompt-field">
                            <h2 class="prompt-title">Prompt field</h2>
                            <p class="prompt-subtitle">Fill the prompt field to generate content</p>

                            <div class="mb-3">
                                <label for="productName" class="form-label">Product/Brand name <i>(Optional)</i></label>
                                <input type="text" class="form-control" id="productName" name="productName" placeholder="Product/Brand name">
                            </div>
                            <div class="mb-3">
                                <label for="services" class="form-label">What service(s) do you provide? <i>(Optional)</i></label>
                                <input type="text" class="form-control" id="services" name="services" placeholder="Services">
                            </div>
                            <div class="mb-3">
                                <label for="wordCount" class="form-label">Number of words for each service <i>(Optional)</i></label>
                                <input type="number" class="form-control" id="wordCount" name="wordCount" placeholder="0">
                            </div>
                        </div>
                        <div class="prompt-field second">
                            <h2 class="prompt-title">General field</h2>
                            <p class="prompt-subtitle">Fill the prompt field to generate content</p>
                            <div class="mb-3">
                                <label for="language" class="form-label">Language <i>(Optional)</i></label>
                                <select class="form-select" id="language" name="language">
                                    <option disabled selected>Select Language</option>
                                    <option value="1">Spanish</option>
                                    <option value="2">French</option>
                                    <option value="3">German</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tone" class="form-label">Tone <i>(Optional)</i></label>
                                <select class="form-select" id="tone" name="tone">
                                    <option disabled selected>Select Tone</option>
                                    <option value="1">Friendly</option>
                                    <option value="2">Formal</option>
                                    <option value="3">Casual</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="writing-style" class="form-label">Writing Style <i>(Optional)</i></label>
                                <select class="form-select" id="writing-style" name="writing-style">
                                    <option disabled selected>Select Writing Style</option>
                                    <option value="1">Analytical</option>
                                    <option value="2">Narrative</option>
                                    <option value="3">Descriptive</option>
                                </select>
                            </div>
                        </div> -->
                    </div>
                <!-- OLD CODE FOR STATIC QUESTIONS ENDS -->
                <div class="col-lg-6">
                    <div class="button-prompt reloadDivBtn">
                        <div class="note"><span style="color: #49DF28;">NB.</span> All prompts generated cost <b>1 GPT</b> token. Ensure to review your prompt before proceeding.</div>


                            <!-- Modal Structure -->
                            <div class="modal fade" id="customModal" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-body text-center">
                                    <!-- Icon -->
                                    <div class="icon-container">
                                        <img src="{{ asset('users-images/coin.png') }}" alt="Coin Icon" class="coin-icon">
                                        <img src="{{ asset('users-images/error.png') }}" alt="Error Icon" class="error-icon">
                                    </div>
                                    <!-- Text -->
                                    <h5 class="modal-title mt-3">Low Coin</h5>
                                    <p class="modal-text">Oops! We noticed you don’t have enough coins to generate content. Get more coins to continue.</p>
                                    <!-- Button -->
                                    <button type="button" onclick="goToPurchaseCoins()" class="btn btn-suc" data-bs-dismiss="modal">Purchase Spark Credits</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php
                        if(!empty($getWallet)){
                            if(($getWallet->balance_in_wallet) == 0){
                        ?>
                                    <!-- <button type="button" class="generate-button disabCls">Generate Content</button>  -->
                                    <!-- Trigger Button -->
                                    <button type="button" class="generate-button" data-bs-toggle="modal" data-bs-target="#customModal">
                                    Generate Content
                                    </button>
                        <?php
                            }else{
                        ?>
                                    <button type="button" id="generate-button" class="generate-button" data-id="{{ Illuminate\Support\Facades\Auth::guard('user')->user()->id }}">Generate Content</button>
                        <?php
                            }
                        }
                        ?>
                    </div>
        </form>
        <div class="prompt-field third">
            <div class="prompt-third-box">
                <h2 class="prompt-title">Content Editor</h2>
                <div class="third-btn-group" style="display:flex;">
                    <a class="copy-btn"><img src="{{ asset('users-images/copy-image.png') }}" alt="" width="40px;" height="40px;"></a>
                    <div class="DDivCls" id="hidTextDwnd">
                        <a class="download-btn"><img style="border:#0b0b0b;" width="40px;" height="32px;" src="{{ asset('users-images/download_circle-icon.png') }}" alt="">Download</a>
                    </div>
                    <!-- <div class="DDivCls" id="play-button-wrapper" style="display: none;">
                        <a class="play-btn" style="cursor: pointer;">
                            <img style="border:#0b0b0b;" width="40px;" height="32px;" src="{{ asset('users-images/music-play.png') }}" alt="">
                            Play
                        </a>
                    </div> -->
                    <div class="DDivCls" id="play-button-wrapper" style="display: none;">
                        <audio id="generated-audio" src="" preload="auto"></audio>
                        <a class="play-btn" id="play-pause-btn" style="cursor: pointer;">
                            <img style="border:#0b0b0b;" width="40px;" height="32px;" src="{{ asset('users-images/music-play.png') }}" alt="">
                            <span id="play-text">Play</span>
                        </a>
                    </div>
                    <div class="DDivCls" id="download-wrapper" style="display: none;">
                        <a class="download-btn" id="download-mp3-btn" style="cursor:pointer;">
                            <img style="border:#0b0b0b;" width="40px;" height="32px;" src="{{ asset('users-images/download-music.png') }}" alt="">
                            Download
                        </a>
                    </div>
                </div>
            </div>

            <div class="newClsPrompt prompt-content-field">
                <p id="generated-content"></p>
                <img id="generated-image" src="" alt="" style="display:none; max-width:100%;">
            </div>

            <!-- BEFORE GENERATED CONTENT STARTS -->
            
            <div class="emptyClsPrompt prompt-content-field newPromptContentField">
                <div class="emptyClsDesign">
                    <img id="generated-image" src="{{ asset('users-images/generated_content.png') }}" alt="" style="max-width:100%;">
                </div>
                <div class="emptyClsDesign">
                    <h3 style="display:flex;justify-content:center!important;width: 250px;">
                        Generated Content Appears Here
                    </h3>
                </div>
                <div class="emptyClsDesign">
                    <p style="display:flex;justify-content:center!important;width: 250px;">
                        Your generated content will appear here once prompted
                    </p>
                </div>
            </div>
            <!-- BEFORE GENERATED CONTENT ENDS -->
        </div>
    </div>
</section>

<script>
    function goToPurchaseCoins(){
        var link = document.createElement('a');
        link.href = "{{ route('subscription.index') }}";
        document.body.appendChild(link);
        link.click();
    }

    // $(document).ready(function() {
    //     $(".newClsPrompt").css('display','none');
    //     $(".third-btn-group").addClass("disAbCls");

    //     // Clear validation when user starts typing
    //     $(document).on('input', '[required]', function() {
    //         $(this).removeClass('is-invalid');
    //         $(this).next('.invalid-feedback').text('');
    //     });

    //     $('#generate-button').on('click', function(e) {
    //         e.preventDefault();

        
    //         // Clear ALL validation states FIRST
    //         $('[required]').removeClass('is-invalid');
    //         $('.invalid-feedback').text('');

    //         // Then validate
    //         let hasErrors = false;
    //         $('[required]').each(function() {
    //             if ($(this).val() === '') {
    //                 hasErrors = true;
    //                 $(this).addClass('is-invalid');
    //                 $(this).next('.invalid-feedback').text('This field is required');
    //             }
    //         });
    //         if (hasErrors) return false;

    //         var promptType = $('input[name="prompt_type"]').val();
    //         var url = '{{ route("tools.prompt.store") }}';

    //         if (promptType === 'image') {
    //             url = '{{ route("tools.prompt.image.store") }}'; // Adjust this route as needed
    //         }

    //         $.ajax({
    //             url: url,
    //             method: 'POST',
    //             data: $('#createContent').serialize(),
    //             beforeSend: function() {
    //                 $('#generate-button').prop('disabled', true).text('Generating...');
    //                 $('#generated-content').html(''); // Clear previous content
    //                 $('#generated-image').hide().attr('src', ''); // Clear previous image
    //             },
    //             success: function(data) {
    //                 $(".emptyClsPrompt").css('display','none');
    //                 $(".newClsPrompt").css('display','block');
    //                 $(".third-btn-group").removeClass("disAbCls");
    //                 console.log(data);
    //                 try {
    //                     if (promptType === 'image') {
    //                         if (data.success) {
    //                             $('#generated-image').attr('src', data.message).show();
    //                         }
    //                     } else{
    //                         var response = JSON.parse(data);
    //                         typeWriter(response.content, 0);
    //                     }
    //                 } catch (e) {
    //                     console.error('Error parsing JSON response:', e);
    //                 }
    //             },
    //             complete: function() {
    //                 $('#generate-button').prop('disabled', false).text('Generate Content');
    //             },
    //             error: function(xhr, status, error) {
    //                 $(".newClsPrompt").css('display','none');
    //                 $(".third-btn-group").addClass("disAbCls");
    //                 console.error(error);
    //                 alert('An error occurred while generating content. Please try again.');
    //             }
    //         });
    //     });

    //     function typeWriter(text, i) {
    //         if (i < text.length) {
    //             if (text.charAt(i) === '\n') {
    //                 $('#generated-content').append('<br>');
    //                 i++;
    //                 setTimeout(function() {
    //                     typeWriter(text, i);
    //                 }, 100);
    //             } else {
    //                 $('#generated-content').append(text.charAt(i));
    //                 i++;
    //                 setTimeout(function() {
    //                     typeWriter(text, i);
    //                 }, 30);
    //             }
    //         }
    //     }

    //     $('.copy-btn').on('click', function() {
    //         var promptType = $('input[name="prompt_type"]').val();
    //         if (promptType === 'image') {
    //             var imageUrl = $('#generated-image').attr('src');
    //             copyToClipboard(imageUrl);
    //             alert('Image URL copied to clipboard');
    //         } else {
    //             var text = $('#generated-content').text();
    //             copyToClipboard(text);
    //             alert('Text copied to clipboard');
    //         }
    //     });

    //     $('.download-btn').on('click', function() {
    //         var promptType = $('input[name="prompt_type"]').val();
    //         if (promptType === 'image') {
    //             var imageUrl = $('#generated-image').attr('src');
    //             downloadFile(imageUrl, 'image.jpg');
    //         } else {
    //             var text = $('#generated-content').text();
    //             var blob = new Blob([text], { type: 'text/plain' });
    //             var url = URL.createObjectURL(blob);
    //             downloadFile(url, 'content.txt');
    //             URL.revokeObjectURL(url);
    //         }
    //     });

    //     function downloadFile(url, filename) {
    //         var link = document.createElement('a');
    //         link.href = url;
    //         link.download = filename;
    //         document.body.appendChild(link);
    //         link.click();
    //         document.body.removeChild(link);
    //     }


    //     function copyToClipboard(text) {
    //         var tempInput = document.createElement('input');
    //         tempInput.style = 'position: absolute; left: -1000px; top: -1000px';
    //         tempInput.value = text;
    //         document.body.appendChild(tempInput);
    //         tempInput.select();
    //         document.execCommand('copy');
    //         document.body.removeChild(tempInput);
    //     }

    // });

    $(function () {
        // Reset UI
        $(".newClsPrompt").hide();
        $(".third-btn-group").addClass("disAbCls");

        // Clear invalid styles as user types
        $(document).on('input', '[required]', function () {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').text('');
        });

        // Bind click event
        $(document).on('click', '#generate-button', function (e) {
            e.preventDefault();

            let $btn = $(this);
            $btn.prop('disabled', true).text('Validating...');

            let hasErrors = false;
            $('[required]').each(function () {
                if (!$(this).val().trim()) {
                    $(this).addClass('is-invalid');
                    $(this).next('.invalid-feedback').text('This field is required');
                    hasErrors = true;
                }
            });

            if (hasErrors) {
                $btn.prop('disabled', false).text('Generate Content');
                return;
            }

            let promptType = $('input[name="prompt_type"]').val();
            let url = '{{ route("tools.prompt.store") }}';
            if (promptType === 'image') {
                url = '{{ route("tools.prompt.image.store") }}';
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: $('#createContent').serialize(),
                beforeSend: function () {
                    $btn.text('Generating...');
                    $('#generated-content').empty();
                    $('#generated-image').hide().attr('src', '');
                },
                success: function (data) {
                    $(".emptyClsPrompt").hide();
                    $(".newClsPrompt").show();
                    $(".third-btn-group").removeClass("disAbCls");

                    try {
                        if (promptType === 'image') {
                            if (data.success) {
                                $('#generated-image').attr('src', data.message).show();
                            }
                        } else {
                            let response = JSON.parse(data);
                            typeWriter(response.content, 0);
                            console.log(response);
                            // if (response.mp3_url) {
                            //     $('#hidTextDwnd').hide();
                            //     $('#download-wrapper').show();
                            //     $("#play-button-wrapper").show();
                            //     $('#download-mp3-btn').off('click').on('click', function () {
                            //         downloadFile(response.mp3_url, 'generated-song.mp3');
                            //     });
                            // }
                                // In your AJAX success handler where you show the play button:
                                if (response.mp3_url) {
                                    $('#hidTextDwnd').hide();
                                    $('#download-wrapper').show();
                                    $("#play-button-wrapper").show();
                                    
                                    // Set the audio source
                                    audioPlayer.src = response.mp3_url;
                                    
                                    // Preload the audio
                                    audioPlayer.load();
                                    
                                    // Update download button
                                    $('#download-mp3-btn').off('click').on('click', function() {
                                        downloadFile(response.mp3_url, 'generated-song.mp3');
                                    });
                                }
                        }
                    } catch (e) {
                        console.error('JSON Parse Error', e);
                        alert("Failed to parse response");
                    }
                },
                error: function (xhr) {
                    $(".newClsPrompt").hide();
                    $(".third-btn-group").addClass("disAbCls");
                    console.error(xhr.responseText);
                    alert('An error occurred. Please try again.');
                },
                complete: function () {
                    $btn.prop('disabled', false).text('Generate Content');
                }
            });
        });

        function typeWriter(text, i) {
            if (i < text.length) {
                if (text.charAt(i) === '\n') {
                    $('#generated-content').append('<br>');
                } else {
                    $('#generated-content').append(text.charAt(i));
                }
                setTimeout(() => typeWriter(text, i + 1), 30);
            }
        }

        $('.copy-btn').on('click', function () {
            const promptType = $('input[name="prompt_type"]').val();
            let text = promptType === 'image' ? $('#generated-image').attr('src') : $('#generated-content').text();
            copyToClipboard(text);
            alert('Copied to clipboard');
        });

        $('.download-btn').on('click', function () {
            const promptType = $('input[name="prompt_type"]').val();
            if (promptType === 'image') {
                downloadFile($('#generated-image').attr('src'), 'image.jpg');
            } else {
                let text = $('#generated-content').text();
                let blob = new Blob([text], { type: 'text/plain' });
                let url = URL.createObjectURL(blob);
                downloadFile(url, 'content.txt');
                URL.revokeObjectURL(url);
            }
        });

        function downloadFile(url, filename) {
            let link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function copyToClipboard(text) {
            let tempInput = document.createElement('input');
            tempInput.style = 'position: absolute; left: -1000px; top: -1000px';
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
        }
    });

    // // Handle Play Button (Text-to-Speech)
    // $(document).on('click', '.play-btn', function () {
    //     let text = $('#generated-content').text().trim();
    //     if (text.length === 0) return;

    //     const utterance = new SpeechSynthesisUtterance(text);
    //     utterance.lang = 'en-US';
    //     utterance.rate = 1;
    //     window.speechSynthesis.speak(utterance);
    // });

    // Handle Play Button (Text-to-Speech)
    // $(document).on('click', '.play-btn', function() {
    //     let text = $('#generated-content').text().trim();
    //     if (text.length === 0) return;

    //     // Clean up text for better speech
    //     text = text.replace(/\n/g, ' ').replace(/\s+/g, ' ');
        
    //     const utterance = new SpeechSynthesisUtterance(text);
    //     utterance.lang = 'en-US';
    //     utterance.rate = 0.9; // Slightly slower
    //     utterance.pitch = 1.0; // Normal pitch
    //     utterance.volume = 1.0; // Full volume
        
    //     // Try to get a better voice if available
    //     const voices = window.speechSynthesis.getVoices();
    //     const preferredVoice = voices.find(v => v.name.includes('Google')) || 
    //                         voices.find(v => v.name.includes('Microsoft'));
        
    //     if (preferredVoice) {
    //         utterance.voice = preferredVoice;
    //     }
        
    //     window.speechSynthesis.speak(utterance);
    // });


    // Global variable to track audio state
    let audioPlayer = null;

    $(document).ready(function() {
        // Initialize audio player when document is ready
        audioPlayer = document.getElementById('generated-audio');
        
        // Handle play/pause button click
        $(document).on('click', '#play-pause-btn', function() {
            if (audioPlayer.paused) {
                audioPlayer.play();
                $('#play-text').text('Pause');
                $('#play-pause-btn img').attr('src', "{{ asset('users-images/music-pause.png') }}");
            } else {
                audioPlayer.pause();
                $('#play-text').text('Play');
                $('#play-pause-btn img').attr('src', "{{ asset('users-images/music-play.png') }}");
            }
        });
        
        // Update button when audio ends
        audioPlayer.addEventListener('ended', function() {
            $('#play-text').text('Play');
            $('#play-pause-btn img').attr('src', "{{ asset('users-images/music-play.png') }}");
        });
    });



</script>

@endsection('content')
