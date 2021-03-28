@extends('admin.template')

@section('title', 'Setare categorii')


@section('content')
    <h1 class="my-4">
        Setare categorii pentru <span class="text-info"> {{ $page->title }}</span>
    </h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item "><a href="{{ route('admin.pages') }}">Articole</a></li>
        <li class="breadcrumb-item active">Setare categorii - {{ $page->title }}</li>
    </ol>

    <div class="card form-setting">
        <form action="{{ route('admin.pages.setCategories', $page->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="card-title">
                Setare categorii <span class="text-info"> {{ $page->title }}</span>
            </div>
            <div class="card-body">


                <div class="form-row">
                    @foreach ($categories as $category)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                    id="check-{{ $category->id }}" name="categs[]"
                                    {{ $page->categories()->find($category->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="check-{{ $category->id }}">
                                    {{ $category->title }}
                                </label>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-footer text-right">
                <a href="{{ route('admin.pages') }}" type="submit" class="btn btn-secondary ">Cancel</a>
                <button type="submit" class="btn btn-primary ml-4">Set Categories</button>
            </div>
        </form>

    </div>



@endsection
