@extends('front.template')

@section('meta_description', $category->meta_description)
@section('meta_keywords', $category->meta_keywords)
@section('meta_title', $category->meta_title)


@section('content')

    <div class="row align-items-top">
        <div class="col-md-7 text-center">
            <h1>{{ $category->title }}</h1>
            <div class="photo-article">
                <img src="/images/categories/{{ $category->photo }}" alt="">
            </div>
            <h3 class="text-center text-secondary">
                {{ $category->subtitle }}
            </h3>
            <hr>
            {!! $category->excerpt !!}
        </div>
        <div class="col-md-5 border-right border-dark text-center">


            @include('front.partials.contact-form')


        </div>
    </div>

    <hr>

    @if ($category->pages()->count() > 0)
        @foreach ($category->pages as $page)
            <div class="row my-3 info-pages align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('page.info', $page->slug) }}" title="click pentru a viziona articolul">
                        <div class="photo-article">

                            <img src="/images/pages/{{ $page->photo }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <h2>{{ $page->title }}</h2>
                    <hr>
                    <h3>{{ $page->subtitle }}</h3>
                </div>

            </div>
            <hr>
        @endforeach
    @else
        <h2>Nu exista pagini in aceasta sectiune!<h2>
    @endif

@endsection
