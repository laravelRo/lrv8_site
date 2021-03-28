@extends('front.template')

@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_title', $page->meta_title)


@section('content')

    <div class="article-head shadow border">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1>{{ $page->title }}</h1>

                <div class="photo-article"">
                                                    <img src=" /images/pages/{{ $page->photo }}" alt=""
                    title="{{ $page->meta_description }}">
                </div>
                <h2>{{ $page->subtitle }}</h2>

            </div>
            <div class="col-md-4">
                <div class="presentation">
                    {!! $page->presentation !!}
                    <hr>
                    @foreach ($page->public_categories() as $category)
                        <a class="badge badge-warning"
                            href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="meta">
                <b>author</b> <span class="bg-light"><a href="{{ route('articles', ['author' => $page->author->id]) }}">
                        {{ $page->author->name }} -
                        {{ $page->author->public_pages()->count() }}</a></span> &nbsp;
                | &nbsp;
                <b>data publicarii</b> {{ $page->published_at->format('d M Y') }} &nbsp; | &nbsp;
                <b>vizualizari</b> {{ $page->views }} &nbsp; | &nbsp;
            </div>
        </div>
    </div>

    <div class="article-content">
        {!! $page->content !!}
    </div>

@endsection
