@extends('front.template')

@section('meta_description')
@section('meta_keywords')
@section('meta_title', 'Lista articole')


@section('content')

    @isset($all_articles)
        @include('front.partials.articles-list',['pages'=>$pages,'title'=>$all_articles])
    @endisset

    @isset($author)
        @include('front.partials.articles-list',['pages'=>$pages,'title'=>$author])
    @endisset

    @isset($search)
        @include('front.partials.articles-list',['pages'=>$pages,'title'=>$search])
    @endisset


@endsection
