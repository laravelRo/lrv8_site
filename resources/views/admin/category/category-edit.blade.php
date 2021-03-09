@extends('admin.template')

@section('title', 'Editare categorie')

@section('content')
    <h1 class="my-4">
        Editare categorie <span class="text-info">{{ $category->title }}</span>
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.categories') }}">Categorii</a></li>
        <li class="breadcrumb-item active">Editare categorie {{ $category->title }}</li>
    </ol>

    <div class="card p-4">

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="title">Categorie</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror " id="title"
                        placeholder="Numele noii categorii" value="{{ old('title') ? old('title') : $category->title }}">
                    @error('title') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="slug">Slug</label>
                    <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror " id="slug"
                        placeholder="Adresa paginii tip slug" value="{{ old('slug') ? old('slug') : $category->slug }}">
                    @error('slug') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="subtitle">Subtitle</label>
                    <input name="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror "
                        id="subtitle" placeholder="Subtitlul noii categorii"
                        value="{{ old('subtitle') ? old('subtitle') : $category->subtitle }}">
                    @error('subtitle') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-8">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror " id="excerpt"
                        placeholder="Descrierea paginii categoriei">{{ old('excerpt') ? old('excerpt') : $category->excerpt }}</textarea>

                    @error('excerpt') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="views">Vizualizari</label>
                    <input name="views" type="number" defaultValue="0" min="0"
                        class="form-control @error('views') is-invalid @enderror " id="views"
                        placeholder="Numarul de vizualizari"
                        value="{{ old('views') ? old('views') : $category->views }}">
                    @error('views') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="order">Pozitie</label>
                    <input name="position" type="number" class="form-control @error('position') is-invalid @enderror "
                        id="position" placeholder="Ordinea de afisare" value="{{ $category->position }}">
                    @error('position') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">

                    <div id="img-preview">
                        <img id="photo-preview" src="/images/categories/{{ $category->photo }}" alt="no photo"
                            style="max-width: 200px; max-height:200px; display:inline-block;">
                    </div>
                    <div class="custom-file">
                        <input type="file" accept="image/*" class="custom-file-input" name="photo" id="photoFile">
                        <label class="custom-file-label" for="customFile">Selectati imagine</label>
                    </div>
                    @error('photo') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-2">

                    <div class="form-check mt-3 text-info">
                        <input class="form-check-input" type="checkbox" value="1" id="publish" name="publish"
                            {{ $category->publish == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="publish">
                            Afisat
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-row bg-light my-4">
                <div class="form-group col-md-4">
                    <label for="meta_title">Meta title</label>
                    <input name="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror "
                        id="meta_title" placeholder="Tagul meta title al categoriei"
                        value="{{ old('meta_title') ? old('meta_title') : $category->meta_title }}">
                    @error('meta_title') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="meta_description">Meta description</label>
                    <input name="meta_description" type="text"
                        class="form-control @error('meta_description') is-invalid @enderror " id="meta_description"
                        placeholder="Tagul meta description al categoriei"
                        value="{{ old('meta_description') ? old('meta_description') : $category->meta_description }}">
                    @error('meta_description') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="meta_keywords">Meta keywords</label>
                    <input name="meta_keywords" type="text"
                        class="form-control @error('meta_keywords') is-invalid @enderror " id="meta_keywords"
                        placeholder="Tagul meta keywords al categoriei"
                        value="{{ old('meta_keywords') ? old('meta_keywords') : $category->meta_keywords }}">
                    @error('meta_keywords') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>


            </div>

            <button type="submit" class="btn btn-primary float-right ml-4">Update categorie</button>
            <a href="{{ route('admin.categories') }}" type="submit" class="btn btn-secondary float-right">Cancel</a>

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

    </script>

@endsection
