@extends('front.template')

@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_title', $page->meta_title)

@section('customCss')
    <link href="/admin/assets/photos/magnific.css" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('content')

    <div class="article-head shadow border" style="background-color: rgb(238, 246, 249);">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1>{{ $page->title }}</h1>

                <div class="photo-article"">
                    <img src=" /images/pages/{{ $page->photo }}" alt="" title="{{ $page->meta_description }}">
                </div>
                <h2>{{ $page->subtitle }}</h2>
                <hr>
                <div class="presentation">
                    {!! $page->presentation !!}
                    <hr>
                    <a class="badge badge-warning" href="{{ route('category.info') }}">Site info pages</a>
                </div>

            </div>
            <div class="col-md-5">
                @include('front.partials.contact-form')
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    @if ($page->public_photos()->count() > 0)

        {{ $page->public_photos()->links() }}
        <div class="popup-gallery">
            <div class="row">
                @foreach ($page->public_photos() as $photo)
                    <div class="col-md-4 my-4 border-right border-dark d-flex flex-column justify-content-between">

                        <a href="{{ $photo->photo_url() }}" class="magnific-gallery my-4">
                            <span class="badge badge-secondary float-left " style="width: max-content;">
                                {{ $page->public_photos()->currentPage() > 1 ? $loop->iteration + $page->public_photos()->perPage() * ($page->public_photos()->currentPage() - 1) : $loop->iteration }}
                            </span>
                            <img class="photo" src="{{ $photo->photo_url() }}" alt="" title="{{ $photo->title }}">
                        </a>

                        <div class="bg-dark text-center">
                            <small class="text-light">{{ $photo->title }}</small>
                            <br>
                            <small class="text-light">{{ $photo->description }}</small>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    @endif
    <div class="article-content">
        {!! $page->content !!}
    </div>

@endsection

@section('customJs')
    <script src="/admin/assets/photos/magnific.js"></script>

    <script>
        $(document).ready(function() {
            $('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
            });
        })

    </script>
@endsection
