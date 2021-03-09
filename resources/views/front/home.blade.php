@extends('front.template')

@section('meta_description', 'Pagina home a sitului cadru Web Design')
@section('meta_keywords', 'Web design, laravel, sullstack, dinamic site')
@section('meta_title', 'Web design | HOME')

@section('content')

    @include('front.partials.banner')
    @include('front.partials.categories')

@endsection
