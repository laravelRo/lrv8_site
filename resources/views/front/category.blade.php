@extends('front.template')

@section('meta_description', $category->meta_description)
@section('meta_keywords', $category->meta_keywords)
@section('meta_title', $category->meta_title)


@section('content')

    <!-- Category Heading -->
    <div class="page-heading">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1>{{ $category->title }}</h1>
                    <img src="/images/categories/{{ $category->photo }}" </div>

                </div>
                <div class="col-md-5">
                    <h2>{{ $category->subtitle }}</h2>

                    {!! $category->excerpt !!}

                    <p class="text-right ">vizualizari: <span class="text-info"><b>{{ $category->views }}</b></span></p>

                </div>
            </div>
        </div>
    </div>

    @include('front.partials.articles-list',['pages'=>$category->public_pages(),'title'=>'Articole in
    categorie'])


@endsection
