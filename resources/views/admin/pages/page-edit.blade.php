@extends('admin.template')

@section('title', 'Editare articol')

@section('content')
    <h1 class="my-4">
        Editare Articol <span class="text-info">{{ $page->title }}</span>


    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.pages') }}">Articole</a></li>
        <li class="breadcrumb-item active">Editare articol ({{ $page->id }})- {{ $page->title }}</li>
        <li class="breadcrumb-item "><a href="{{ route('admin.pages.galery', $page->id) }}">Galerie foto</a></li>
    </ol>

    <div class="card p-4">

        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data"
            class="article-form">
            @csrf
            @method('put')
            <div class="row">
                {{-- === prima coloana a formularului === --}}
                <div class="col-md-9">
                    <h4>Partea de continut</h4>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="title">Titlul articolului</label>
                            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror "
                                id="title" placeholder="Titlul articolului"
                                value="{{ old('title') ? old('title') : $page->title }}" required>
                            @error('title') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror "
                                id="slug" placeholder="Adresa paginii tip slug"
                                value="{{ old('slug') ? old('slug') : $page->slug }}" required>
                            @error('slug') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="subtitle">Subtitle</label>
                            <input name="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror "
                                id="subtitle" placeholder="Subtitlul articolului"
                                value="{{ old('subtitle') ? old('subtitle') : $page->subtitle }}">
                            @error('subtitle') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="excerpt">Excerpt</label>
                            <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror "
                                id="excerpt"
                                placeholder="Descrierea paginii in liste">{{ old('excerpt') ? old('excerpt') : $page->excerpt }}</textarea>

                            @error('excerpt') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="presentation">Presentation</label>
                            <textarea name="presentation" class="form-control @error('presentation') is-invalid @enderror "
                                id="presentation"
                                placeholder="Descrierea paginii">{{ old('presentation') ? old('presentation') : $page->presentation }}</textarea>

                            @error('presentation') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror "
                                id="content"
                                placeholder="Continutul paginii paginii">{{ old('content') ? old('content') : $page->content }}</textarea>

                            @error('content') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>


                    </div>

                </div>

                {{-- ==== a doua coloana a formularului === --}}
                <div class="col-md-3">
                    <h4>Administrare articol</h4>
                    <div class="form-row bg-light my-4">
                        @if (isset($authors))
                            <div class="form-group col-md-12">
                                <label for="user_id">Autorul articolului</label>
                                <select name="user_id" class="custom-select" id="user_id">
                                    @foreach ($authors as $author)
                                        <option {{ $author->id == $page->user_id ? 'selected' : '' }}
                                            value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group col-md-12">
                            <label for="meta_title">Meta title</label>
                            <input name="meta_title" type="text"
                                class="form-control @error('meta_title') is-invalid @enderror " id="meta_title"
                                placeholder="Tagul meta title al categoriei"
                                value="{{ old('meta_title') ? old('meta_title') : $page->meta_title }}">
                            @error('meta_title') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meta_description">Meta description</label>
                            <input name="meta_description" type="text"
                                class="form-control @error('meta_description') is-invalid @enderror " id="meta_description"
                                placeholder="Tagul meta description al categoriei"
                                value="{{ old('meta_description') ? old('meta_description') : $page->meta_description }}">
                            @error('meta_description') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meta_keywords">Meta keywords</label>
                            <input name="meta_keywords" type="text"
                                class="form-control @error('meta_keywords') is-invalid @enderror " id="meta_keywords"
                                placeholder="Tagul meta keywords al categoriei"
                                value="{{ old('meta_keywords') ? old('meta_keywords') : $page->meta_keywords }}">
                            @error('meta_keywords') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">

                            <div id="img-preview">
                                <img id="photo-preview" src="/images/pages/{{ $page->photo }}" alt="no photo"
                                    style="max-width: 200px; max-height:200px; display:inline-block;">
                            </div>
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="photo" id="photoFile">
                                <label class="custom-file-label" for="customFile">Selectati imagine</label>
                            </div>
                            @error('photo') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>



                        <div class="form-group col-md-12">

                            <div class="form-check mt-3 text-info">
                                <input class="form-check-input" type="checkbox" value="1" id="publish" name="publish"
                                    {{ isset($page->published_at) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="publish">
                                    Articol publicat
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-1">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="published_at">Data publicarii<br>
                                <span class="text-info">
                                    {{ isset($page->published_at) ? $page->published_at->format('d - M - Y') : 'Nepublicat' }}
                                </span>
                            </label>
                            <input name="published_at" type="date"
                                class="form-control @error('published_at') is-invalid @enderror " id="published_at"
                                placeholder="Data publicarii articolului"
                                value="{{ $page->published_at ? $page->published_at->format('Y-m-d') : date('Y-m-d') }}">
                            @error('published_at') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="views">Vizualizari</label>
                            <input name="views" type="number" defaultValue="0" min="0"
                                class="form-control @error('views') is-invalid @enderror " id="views"
                                placeholder="Numarul de vizualizari"
                                value="{{ old('views') ? old('views') : $page->views }}">
                            @error('views') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>


                    </div>



                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right ml-4">Update Articol</button>
            <a href="{{ route('admin.pages') }}" type="submit" class="btn btn-secondary float-right">Cancel</a>

        </form>
    </div>
@endsection

@section('customJs')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"> </script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()


        });

    </script>


    <script>
        const chooseFile = document.getElementById("photoFile");
        const imgPreview = document.getElementById("img-preview");
        chooseFile.addEventListener("change", function() {
            getImgData();
        });

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    imgPreview.innerHTML = '<img src="' + this.result +
                        '" style="max-height:200px; max-width:200px;" class="photo-preview"/>';
                });
            }
        }

    </script>
    <script type="text/javascript">
        //crearea automata a slugului
        $('#title').on('blur', function() {

            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                .replace(/[^a-z0-9-]+/g, '-')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });

    </script>

    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('excerpt');
        CKEDITOR.replace('presentation');
        CKEDITOR.replace('content');

    </script>

@endsection
