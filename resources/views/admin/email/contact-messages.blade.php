@extends('admin.template')

@section('title', 'Manage messages')

@section('content')
    <h1 class="my-4">
        Manage contact messages
    </h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Control panel</a></li>
        <li class="breadcrumb-item active">Messages</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Mesaje de la vizitatori - {{ $messages->count() }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nume</th>
                            <th>Email / Phone</th>
                            <th>Mesaj</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>

                                <td>{{ $message->created_at }}
                                    {{-- {{ $message->created_at->format('D j F - Y') }} --}}
                                </td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }} <br> {{ $message->phone }}</td>
                                <td>{{ $message->message }}</td>


                                <td>

                                    <form id="form-delete-{{ $message->id }}"
                                        action="{{ route('admin.message.delete', $message->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('delete')

                                    </form>

                                    <button class="btn btn-danger btn-circle btn-md"
                                        title="Sterge utilizatorul din baza de date" onclick="
                                                        if(confirm('Confirmati stergerea mesajului?'))
                                                        { document.getElementById('form-delete-{{ $message->id }}').submit(); }
                                                        ">
                                        <i class="fas fa-2x fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>

                            <th>Data</th>
                            <th>Nume</th>
                            <th>Email / Phone</th>
                            <th>Mesaj</th>
                            <th>Actions</th>


                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>




@endsection
