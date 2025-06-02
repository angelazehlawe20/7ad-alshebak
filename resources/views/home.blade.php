@extends('layouts.app')

@section('content')

  {{-- Hero Section --}}
  @include('partials.hero')

  {{-- About Us Section --}}
  @include('partials.about')

  {{-- Offers Section --}}
  @include('partials.offers')

@endsection
