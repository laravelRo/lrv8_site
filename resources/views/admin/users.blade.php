@extends('admin.template')

@section('title', 'Manage Users')

@section('content')
    <h1 class="my-4">
        Manage users
    </h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Users - {{ $users->count() }}

            <a href="{{ route('users.new') }}" class="btn btn-success float-right">New User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><i class="fa fa-check" aria-hidden="true"></i></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address / Phone</th>
                            <th class="text-center">Photo</th>
                            <th>Role</th>

                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{!! $user->hasVerifiedEmail()
    ? '<i class="fa fa-check" aria-hidden="true"></i>'
    : '<i
                                        class="fa fa-2x fa-minus-circle text-danger" aria-hidden="true"></i>' !!}
                                </td>
                                <td>{{ $user->name }}<br>
                                    {{ $user->created_at->format('D j F - Y') }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }} <br> {{ $user->phone }}</td>
                                <td> <img class="user-avatar mx-auto" src="/images/users/{{ $user->photo }}"
                                        alt="{{ $user->name }}">
                                </td>
                                <td>
                                    @if ($user->role == 'author')
                                        <a href="{{ route('admin.pages', ['author' => $user->id]) }} "
                                            title="click pentru a vedea paginile de autor">{{ $user->role }} -
                                            {{ $user->pages->count() }}</a>
                                    @else
                                        {{ $user->role }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.editForm', $user->id) }}"
                                        class="btn btn-success btn-circle btn-md" title="Editeaza datele utilizatorului"><i
                                            class="fas fa-2x fa-user-edit"></i>
                                    </a>

                                    <form id="form-delete-{{ $user->id }}"
                                        action="{{ route('users.delete', $user->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('delete')

                                    </form>


                                    <button class="btn btn-danger btn-circle btn-md"
                                        title="Sterge utilizatorul din baza de date" onclick="
                                                                                      if(confirm('Confirmati stergerea utilizatorului {{ $user->name }}?')){
                                                                                             document.getElementById('form-delete-{{ $user->id }}').submit();
                                                                                                 }
                                                                                        ">
                                        <i class="fas fa-2x fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><i class="fa fa-check" aria-hidden="true"></i></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address / Phone</th>
                            <th class="text-center">Photo</th>
                            <th>Role</th>

                            <th>Actions</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>




@endsection
