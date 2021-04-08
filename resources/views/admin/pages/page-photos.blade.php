@extends('admin.template')

@section('title', 'Galerie foto')

@section('customCss')
    <link href="/admin/assets/photos/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/photos/magnific.css" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="my-4">
        Galerie foto <span class="text-info">{{ $page->title }}</span>
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.pages') }}">Articole</a></li>
        <li class="breadcrumb-item active">Galerie foto - {{ $page->title }}</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.pages.edit', $page->id) }}">Edit page ({{ $page->id }})
                -
                {{ $page->title }}</a></li>
    </ol>

    <div class="card p-4">
        <h2>Selectati imagini pentru galeria foto <small class="text-muted"> Maximum 8 imagini / upload </small> </h2>
        <form action="{{ route('admin.pages.upload.photos', $page->id) }}" enctype="multipart/form-data" accept="image/*"
            method="POST">
            @csrf


            <div class="row">
                <div class="col">
                    <input id="photo" name="photo[]" type="file" class="file" multiple data-show-upload="true"
                        data-show-remove="false" data-show-caption="true"
                        data-msg-placeholder="Selectati {files} pentru galerie...">
                    <button class="btn btn-danger float-left" onclick="$('#photo').fileinput('clear');">Clear</button>
                </div>
            </div>

        </form>
        @if ($page->photos()->count() > 0)
            <h2 class="text-center my-3">Imagini galerie foto - {{ $page->photos()->total() }} </h2>
            <div>
                <form id="form-delete-all" action="{{ route('admin.pages.delete-all.photos', $page->id) }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('delete')
                </form>
                <button class="btn btn-danger float-right" onclick="if(confirm('Confirmati stergerea galeriei foto in totalitate?'))
                            {document.getElementById('form-delete-all').submit(); } ">Delete-all</button>
            </div>
            {{ $page->photos()->links() }}
            <div class="row">
                @foreach ($page->photos() as $photo)

                    <div class="col-md-3 my-4 border-right border-dark d-flex flex-column justify-content-between">
                        <a href="{{ $photo->photo_url() }}" class="magnific-gallery">
                            <span class="badge badge-secondary float-left " style="width: max-content;">
                                {{ $page->photos()->currentPage() > 1 ? $loop->iteration + $page->photos()->perPage() * ($page->photos()->currentPage() - 1) : $loop->iteration }}
                            </span>
                            <img class="photo" src="{{ $photo->photo_url() }}" alt="">
                        </a>

                        <form id="form-edit-{{ $photo->id }}"
                            action="{{ route('admin.pages.save.photo', $photo->id) }}" enctype="multipart/form-data"
                            accept="image/*" method="POST">
                            @csrf
                            @method('put')
                            <div class=" row">
                                <div class="col-12">
                                    <input name="title" type="text" id="title" value="{{ $photo->title }}"
                                        class="form-control my-2" placeholder="Titlul imaginii">
                                </div>
                                <div class="col-12">
                                    <input name="description" type="text" id="description"
                                        value="{{ $photo->description }}" class="form-control my-2 "
                                        placeholder="Descrierea imaginii">
                                </div>
                                <div class="col-6">
                                    <input name="position" type="number" id="position" value="{{ $photo->position }}"
                                        class="form-control my-2 " placeholder="Ordine afisare">
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check mt-3 text-info">
                                        <input class="form-check-input" type="checkbox" value="1" id="publish"
                                            name="publish" {{ $photo->publish == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="publish">
                                            Imagine publica
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="photo" id="photoFile">
                                <label class="custom-file-label" for="customFile">Selectati imagine</label>
                            </div>

                        </form>

                        <div class="mt-4 bg-dark">
                            <button class=" btn btn-primary float-right" type="submit" title="actualizeaza datele imaginii"
                                onclick="document.getElementById('form-edit-{{ $photo->id }}').submit();">
                                Update
                            </button>

                            <form id="form-delete-{{ $photo->id }}"
                                action="{{ route('admin.pages.delete.photo', $photo->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('delete')

                            </form>

                            <button class="btn btn-danger float-left" title="Sterge imaginea din galerie"
                                onclick=" if(confirm('Confirmati stergerea imaginii din galerie?'))
                                                                                             {document.getElementById('form-delete-{{ $photo->id }}').submit(); } ">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </div>

                    </div>

                @endforeach

            </div>
        @else
            <h2 class="text-center">Nu exista imagini in galeria foto</h2>
        @endif

    </div>


@endsection

@section('customJs')
    <script src="/admin/assets/photos/fileinput.js"></script>
    <script src="/admin/assets/photos/magnific.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"> </script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();

            $('.magnific-gallery').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                }

            });


        });

        $("#photo").fileinput({
            maxFileCount: 8,
            validateInitialCount: true,
        })

    </script>






@endsection
