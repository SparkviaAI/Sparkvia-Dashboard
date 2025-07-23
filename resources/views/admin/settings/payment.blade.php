@extends('layouts.admin')
@section('content')
    @include('admin.settings.cards.stripe')
    @include('admin.settings.cards.currency')
    @include('admin.settings.cards.subscription')
@endsection
