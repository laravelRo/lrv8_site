@extends('admin.template')

@section('title', 'Manage Articles')

@section('content')
    <h1 class="my-4">
        Manage Page-Articles

        @if (isset($categs_title))
            - {{ $pages->total() }} for category <span class="text-info">{{ $categs_title }}</span>
            &nbsp; <a href="{{ route('admin.pages') }}" class="btn btn-success ">All pages</a>
        @endif

        @if (isset($search))
            for search term <span class="text-info">{{ $search }}</span> - {{ $pages->total() }}&nbsp; <a
                href="{{ route('admin.pages') }}" class="btn btn-success ">All pages</a>
        @endif

        @if (isset($author_name))
            for <span class="text-info">{{ $author_name }}</span> &nbsp;
            <a href="{{ route('admin.pages') }}" class="btn btn-success ">All pages</a>
        @endif
        @if (isset($published))
            {{ $published }}
            &nbsp;<a href="{{ route('admin.pages') }}" class="btn btn-success ">All pages</a>
        @endif


    </h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item active">Page-Articles</li>
    </ol>

    <div class="card mb-4">
        {{-- CARD HEADER --}}
        <div class="card-header">

            <div class="row">
                <div class="col-md-4">
                    <b>{{ $pages->total() }}</b> Page-articles <b>{{ $pages->count() }}</b> items / page
                    {{ $pages->links() }}
                </div>
                <div class="col-md-8">
                    <b>Categorii </b><br>
                    @foreach ($categs as $category)
                        <a href="{{ route('admin.pages', ['categs' => $category->id]) }}"
                            class="badge badge-warning">{{ $category->title }}</a>
                    @endforeach

                    @can('author-rights') <a href="{{ route('admin.pages.new') }}" class="btn btn-success float-right">
                            New Article</a>
                    @endcan
                </div>

            </div>


        </div>

        {{-- CARD BODY --}}
        @if ($pages->count() > 0)
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" title="Paginile publicate sau draft"><i class="fas fa-book-reader"></i></th>
                            <th scope="col">@sortablelink('title', 'Title') / @sortablelink('created_at', 'Created')</th>
                            <th scope="col" width="200">Author</th>
                            <th class="text-center" scope="col">Photo</th>
                            <th scope="col" width="150">@sortablelink('views', 'Views')</th>
                            <th scope="col">Description / Categories</th>
                            <th scope="col" style="min-width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)

                            <tr>
                                <td>
                                    @if (isset($page->published_at))
                                        <a href="{{ route('admin.pages', ['published' => 1]) }}"><span
                                                class="text-success"><i class="fas fa-2x fa-book-reader"></i></span></a>
                                    @else
                                        <a href="{{ route('admin.pages', ['published' => 2]) }}"> <span
                                                class="text-danger"><i class="fas fa-2x fa-bookmark"></i></span></a>
                                    @endif
                                </td>
                                <td><b>{{ $page->title }}</b> <br> {{ $page->created_at->format('D j F - Y') }}</td>
                                <td><a href="{{ route('admin.pages', ['author' => $page->author->id]) }}">{{ $page->author->name }}
                                        - {{ $page->author->pages->count() }}</a></td>
                                <td> <img class="user-avatar mx-auto" src="/images/pages/{{ $page->photo }}"> </td>
                                <td>{{ $page->views }}</td>
                                <td> <span class="text-info">{{ $page->meta_description }}</span> <br>

                                    @foreach ($page->categories->sortBy('title') as $category)
                                        <span class="badge badge-secondary">{{ $category->title }}</span>
                                    @endforeach

                                </td>

                                <td>
                                    <div>
                                        <a href="{{ route('admin.pages.showCategories', $page->id) }}"
                                            class="btn btn-info btn-circle btn-sm" title="Seteaza categoriile"><i
                                                class="fas fa-2x fa-list"></i>
                                        </a>

                                        <a href="{{ route('admin.pages.galery', $page->id) }}"
                                            class="btn btn-primary btn-circle btn-sm" title="Seteaza galeria photo"><i
                                                class="fas fa-2x fa-camera"></i>
                                        </a>
                                    </div>
                                    <br>
                                    <div>
                                        <a href="{{ route('admin.pages.edit', $page->id) }}"
                                            class="btn btn-success btn-circle btn-sm" title="Editeaza datele articolului"><i
                                                class="fas fa-2x fa-edit"></i>
                                        </a>
                                        @can('author-rights')


                                            <form id="form-delete-{{ $page->id }}"
                                                action="{{ route('admin.pages.delete', $page->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('delete')

                                            </form>

                                            <button class="btn btn-danger btn-circle btn-sm"
                                                title="Sterge articolul din baza de date"
                                                onclick=" if(confirm('Confirmati stergerea articolului {{ $page->title }}?'))
                                                 {document.getElementById('form-delete-{{ $page->id }}').submit(); } ">
                                                <i class="fas fa-2x fa-trash-alt"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        @else
            <div class="alert alert-warning">
                <h3>Nu exista nici o pagina dupa criteriile selectate</h3>
            </div>
        @endif

        <div class="card-footer">
            {{ $pages->links() }}
        </div>
    </div>


@endsection
