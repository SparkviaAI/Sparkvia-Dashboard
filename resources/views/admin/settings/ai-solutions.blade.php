@extends('layouts.admin.app')
@section('content')

    @include('admin.settings.cards.openai')
    @include('admin.settings.cards.chatbot')
    @include('admin.settings.cards.admin-wallet-keys')
    @include('admin.settings.cards.xrp-to-tokens')

@endsection('content')
