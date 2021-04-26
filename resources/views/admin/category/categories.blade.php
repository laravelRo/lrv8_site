@extends('admin.template')

@section('title', 'Manage Categories')

@section('content')
    <h1 class="my-4">
        Manage Categories
    </h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item active">Categories</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Categories - {{ $categories->count() }}

            @can('author-rights') <a href="{{ route('admin.categories.new') }}" class="btn btn-success float-right">New
                Category</a>@endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ord.</th>
                            <th>Title / Pages</th>
                            <th>Subtitle</th>
                            <th>Views</th>
                            <th class="text-center">Photo</th>
                            <th>Meta Desc / Key</th>

                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="{{ $category->publish == 1 ? 'bg-light' : 'bg-warning' }}">
                                <td>{{ $category->position }}</td>

                                <td>
                                    {{ $category->title }} <small
                                        class="text-danger">(id-{{ $category->id }})</small><br>
                                    <a href="{{ route('admin.pages', ['categs' => $category->id]) }}">pages -
                                        {{ $category->pages()->count() }}</a>
                                </td>
                                <td>{{ $category->subtitle }}</td>
                                <td>{{ $category->views }}</td>
                                <td> <img class="user-avatar mx-auto" src="/images/categories/{{ $category->photo }}"
                                        alt="No photo">
                                </td>
                                <td>
                                    <span class="text-success">{{ $category->meta_description }}</span><br>
                                    <span class="text-info">{{ $category->meta_keywords }}</span>
                                </td>
                                <td style="min-width: 110px;">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-success btn-circle btn-md" title="Editeaza datele categoriei"><i
                                            class="fas fa-2x fa-pencil-alt"></i>
                                    </a>
                                    @can('author-rights')
                                        <form id="form-delete-{{ $category->id }}"
                                            action="{{ route('admin.categories.delete', $category->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('delete')

                                        </form>


                                        <button class="btn btn-danger btn-circle btn-md"
                                            title="Sterge categoria din baza de date"
                                            onclick="
                                                                                            if(confirm('Confirmati stergerea categoriei {{ $category->title }}?')){
                                                                                            document.getElementById('form-delete-{{ $category->id }}').submit();
                                                                                                                                                                         }
                                                                                                                                                                ">
                                            <i class="fas fa-2x fa-trash-alt"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Ord.</th>
                            <th>Title / Pages</th>
                            <th>Subtitle</th>
                            <th>Views</th>
                            <th class="text-center">Photo</th>
                            <th>Meta Desc / Key</th>

                            <th>Actions</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>




@endsection
