@extends('layout.master')
@section('title')
    <title>Users</title>
@endsection
@section('link')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">User Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl id="content">
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Create a User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <form method="post" action="{{ route('users.store') }}" name="createForm" id="createForm">
                            @csrf
                            <label for="name">Name <span class="red">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" autofocus required>
                            </br>
                            <label for=email>Email <span class="red">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" required>
                            </br>
                            <label for="gender">Gender <span class="red">*</span></label>
                            </br>
                            <div class="form-group m-10">
                                <input type="radio" name="gender" value="male" id="male" required>
                                <label for="male">Male</label>
                                <input type="radio" name="gender" value="female" id="female">
                                <label for="female">female</label>
                            </div>
                            </br>
                            <input type="submit" class="btn btn-success">
                            </br>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container center mt-25">
        {{-- <div class="row create">
            <form action="{{ route('users.create') }}" method='GET' target='_blank'>
                @csrf
                <button class="btn btn-success right" type="submit">Create</button>
            </form>
        </div> --}}
        <div class="create d-grid">
            <button class="btn btn-success js-right" type="submit" data-bs-toggle="modal"
                data-bs-target="#createModal">Create</button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="userTable">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" colspan="4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-warning" type="submit" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->id }}">Edit</button>
                                {{--<form action="{{ route('users.edit', $user->id) }}" method='GET' target="_blank">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">Edit</button>
                                </form>--}}
                            </td>
                            <td>
                                <button class="btn btn-primary" type="submit"
                                    onclick="return handleAction({{ $user->id }})" data-bs-toggle="modal"
                                    data-bs-target="#Modal">view</button>
                            </td>
                            <td>
                                <a href="{{ route('projects.show', $user->id) }}" class="btn btn-primary">Projects</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            @foreach ($users as $user)
            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">Edit User Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                @method('put')
                                <label for="name">Name <span class="red">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}"
                                    autofocus required>
                                </br>
                                <label for=email>Email <span class="red">*</span></label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}"
                                    required>
                                </br>
                                <label for="gender">Gender <span class="red">*</span></label>
                                <input type="text" id="gender" value="{{ $user->gender }}" disabled>
                                </br>
                                <div class="form-group m-10">
                                    <input type="radio" name="gender" value="male" id="male" required>
                                    <label for="male">Male</label>
                                    <input type="radio" name="gender" value="female" id="female">
                                    <label for="female">Female</label>
                                </div>
                                </br>
                                <input type="submit" class="btn btn-success">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="pageLinks d-flex">
        {{ $users->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
@endsection
