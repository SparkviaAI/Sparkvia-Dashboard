@extends('layouts.users.app')
@section('content')

<section class="dasboard-all pages pt-4 pb-4">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="back-btn">
                    <p class="go-back"><i class="fa-solid fa-arrow-left"></i> Go Back</p>
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
                    <div class="prompt-field">
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
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="button-prompt">
                        <div class="note"><span style="color: #49DF28;">NB.</span> All prompts generated cost <b>1 GPT</b> token. Ensure to review your prompt before proceeding.</div>
                        <button type="button" id="generate-button" class="generate-button">Generate Content</button>
                    </div>
        </form>
        <div class="prompt-field third">
            <div class="prompt-third-box">
                <h2 class="prompt-title">General field</h2>
                <div class="third-btn-group">
                    <button class="copy-btn"><img src="{{ asset('users-images/Copy.png') }}" alt=""></button>
                    <button class="download-btn"><img src="{{ asset('users-images/Download_circle.png') }}" alt="">Download</button>
                </div>
            </div>

            <div class="prompt-content-field">
                <p id="generated-content"></p>
                <img id="generated-image" src="" alt="" style="display:none; max-width:100%;">
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#generate-button').on('click', function(e) {
            e.preventDefault();

            var promptType = $('input[name="prompt_type"]').val();
            var url = '{{ route("tools.prompt.store") }}';

            if (promptType === 'image') {
                url = '{{ route("tools.prompt.image.store") }}'; // Adjust this route as needed
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: $('#createContent').serialize(),
                beforeSend: function() {
                    $('#generate-button').prop('disabled', true).text('Generating...');
                    $('#generated-content').html(''); // Clear previous content
                    $('#generated-image').hide().attr('src', ''); // Clear previous image
                },
                success: function(data) {
                    console.log(data);
                    try {
                        if (promptType === 'image') {
                            if (data.success) {
                                $('#generated-image').attr('src', data.message).show();
                            }
                        } else{
                            var response = JSON.parse(data);
                            typeWriter(response.content, 0);
                        }
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                },
                complete: function() {
                    $('#generate-button').prop('disabled', false).text('Generate Content');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while generating content. Please try again.');
                }
            });
        });

        function typeWriter(text, i) {
            if (i < text.length) {
                if (text.charAt(i) === '\n') {
                    $('#generated-content').append('<br>');
                    i++;
                    setTimeout(function() {
                        typeWriter(text, i);
                    }, 100);
                } else {
                    $('#generated-content').append(text.charAt(i));
                    i++;
                    setTimeout(function() {
                        typeWriter(text, i);
                    }, 30);
                }
            }
        }
    });
</script>

@endsection('content')
