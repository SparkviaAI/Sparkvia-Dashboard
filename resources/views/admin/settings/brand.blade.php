@extends('layouts.admin.app')
@section('content')

    @include('admin.settings.cards.brand')
    
    <script src="{{ asset('new-js/js/brand.js') }}"></script>

@endsection('content')
