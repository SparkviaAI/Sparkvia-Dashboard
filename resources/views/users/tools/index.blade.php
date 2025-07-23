@extends('layouts.users.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-top">
                    <h1 class="content-hed">{{ $getCategoryDetails->title }}</h1>
                    <!-- <p class="content-pra">Craft your website content to your taste</p> -->
                </div>
            </div>
        </div>
    
        <div class="row">

            @foreach($getAllPrompts as $prompt)
            <div class="col-lg-4 tool-boxes boxChange">
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

    </div>
</section>
@endsection('content')