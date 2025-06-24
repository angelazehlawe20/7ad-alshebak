@extends('layouts.app')

@section('title', __('navbar.home'))

@section('content')

    {{-- Hero Section --}}
    @include('partials.hero')

    {{-- About Us Section --}}
    @include('partials.about')

    {{-- Offers Section --}}
    @include('partials.offers')

@endsection
