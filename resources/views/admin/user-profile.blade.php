@extends('admin.template')

@section('title', 'Editare profil ' . $user->name)

@section('content')
    <h1 class="my-4">
        Editare profil <span class="text-info">{{ $user->name }} </span> - cu rol de
        <span class="text-info">{{ $user->role }}</span>
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>

        <li class="breadcrumb-item active">Edit profile for {{ $user->name }}</li>
    </ol>

    <div class="row">
        <div class="col-md-9">

            <div class="card p-4">

                <form action="{{ route('user.profile-update') }}" method="POST" enctype="multipart/form-data"
                    id="profile">
                    @csrf
                    @method('put')
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="name">Nume</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Numele utilizatorului" value="{{ $user->name }}">
                            @error('name') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Email utilizator" value="{{ $user->email }}">
                            @error('email') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-2">
                            <label for="phone">Telefon</label>
                            <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" placeholder="Telefon utilizator" value="{{ $user->phone }}">
                            @error('phone') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="address">Adresa</label>
                            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" placeholder="Adresa utilizator" value="{{ $user->address }}">
                            @error('address') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>




                    </div>
                    <div class="form-row align-items-end">


                        <div class="form-group col-md-6">

                            <div id="img-preview">
                                <img id="photo-preview" src="{{ '/images/users/' . $user->photo }}" alt=""
                                    style="max-width: 200px; max-height:200px; display:inline-block;">
                            </div>
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="photo" id="photoFile">
                                <label class="custom-file-label" for="customFile">Selectati imagine</label>
                            </div>
                            @error('photo') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>


                    </div>

                    <button type="submit" class="btn btn-primary float-right ml-4">Update Profile</button>
                    <a href="{{ route('users') }}" type="submit" class="btn btn-secondary float-right">Cancel</a>

                </form>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4">
                @if (Session::has('user_message'))
                    <div class="alert alert-warning">
                        {!! Session::get('user_message') !!}
                    </div>
                @endif
                <form action="{{ route('user.reset-password') }}" method="POST" id="reset-password">
                    @csrf
                    @method('put')

                    <h3>Resetare parola utilizator</h3>
                    <div class="form-group">
                        <label for="password">Parola actuala</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Parola">
                        @error('password') <span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Parola noua</label>
                        <input name="passwordnew" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="passwordnew"
                            placeholder="Introduceti noua parola">
                        @error('passwordnew') <span class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="passwordnew_confirmation">Confirmare parola noua</label>
                        <input name="passwordnew_confirmation" type="password"
                            class="form-control @error('passwordnew_confirmation') is-invalid @enderror"
                            id="passwordnew_confirmation" placeholder="Confirmare parola noua">
                        @error('passwordnew_confirmation') <span
                            class="text-danger small">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-danger float-right ml-4" title="Resetare vechea parola">Reset
                        Password</button>

                </form>
            </div>
        </div>

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
