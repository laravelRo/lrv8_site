@extends('admin.template')

@section('title', 'Adaugare utilizator nou')

@section('content')
    <h1 class="my-4">
        Adaugare utilizator nou
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item "><a href="{{ route('users') }}">Users</a></li>
        <li class="breadcrumb-item active">Create new user</li>
    </ol>

    <div class="card p-4">

        <form action="{{ route('users.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="name">Nume</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                        placeholder="Numele utilizatorului" value="{{ old('name') }}">
                    @error('name') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Email utilizator" value="{{ old('email') }}">
                    @error('email') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="phone">Telefon</label>
                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Telefon utilizator" value="{{ old('phone') }}">
                    @error('phone') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="address">Adresa</label>
                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                        id="address" placeholder="Adresa utilizator" value="{{ old('address') }}">
                    @error('address') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>


                <div class="form-group col-md-3">
                    <label for="role">Rol</label>
                    <select id="role" name="role" class="custom-select @error('role') is-invalid @enderror"
                        value="{{ old('role') }}">

                        <option value="admin">Admin</option>
                        <option value="author" selected>Author</option>
                        <option value="editor">Editor</option>
                    </select>
                    @error('role') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="password">Parola</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Parola">
                    @error('password') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="password_confirmation">Confirmare parola</label>
                    <input name="password_confirmation" type="password"
                        class="form-control @error('password_confirmated') is-invalid @enderror" id="password_confirmation"
                        placeholder="Confirmare parola">
                    @error('password_confirmation') <span class="text-danger small">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">

                    <div id="img-preview">
                        <img id="photo-preview" src="/images/users/default.jpg" alt=""
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
                        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="verified">
                        <label class="form-check-label" for="defaultCheck1">
                            Email verificat
                        </label>
                    </div>
                </div>



            </div>

            <button type="submit" class="btn btn-primary float-right ml-4">Create user</button>
            <a href="{{ route('users') }}" type="submit" class="btn btn-secondary float-right">Cancel</a>

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


@endsection
