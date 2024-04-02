@extends('layout.master')
@section('title')
    <title>Show Projects</title>
@endsection
@section('link')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Edit a Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <form method="post" action="{{ route('projects.store') }}">
                            @csrf
                            </br>
                            <label for="user_id">User Id <span class="red">*</span></label>
                            <input type="number" name="user_id" value="{{ $user->id }}" id="user_id" class="form-control" autofocus required>
                            </br>
                            <label for="title">Title <span class="red">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" required>
                            </br>
                            <label for="description">Description <span class="red">*</span></label>
                            <textarea name="description" class="form-control" id="description" required> 
                            </textarea>
                            </br>
                            <input type="submit" class="btn btn-success">
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
        <div class="row create">
            <div class="col">
                {{-- <a href="{{ route('projects.create', ['user_id' => $user_id]) }}" class="btn btn-success right m-1"
                    type="submit" target="_blank">Create</a> --}}

                <button class="btn btn-success right m-1" type="submit" data-bs-toggle="modal"
                    data-bs-target="#createModal">Create</button>
                <form action="{{ route('users.index') }}" method='GET'>
                    @csrf
                    <button class="btn btn-primary right m-1" type="submit">Back</button>
                </form>
            </div>
        </div>

        <h2 class="red"> Projects of {{ $user->name  }}</h2>
        
        <div class="table-responsive">
            <table class="table table-hover" id="userTable">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>
                                <form
                                    action="{{ route('projects.destroy', ['project' => $project->id . '-' . $project->user_id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-warning" type="submit" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $project->id }}">Edit</button>
                                {{--<form action="{{ route('projects.edit', $project->id) }}" method='GET' target="_blank">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">Edit</button>
                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            @foreach ($projects as $project)
            <div class="modal fade" id="editModal{{ $project->id }}" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">Create a Project</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col">
                                <form method="post" action="{{ route('projects.update', $project->id) }}">
                                    @csrf
                                    @method('put')
                                    </br>
                                    <label for="user_id">User Id <span class="red">*</span></label>
                                    <input type="number" value="{{ $project->user_id }}" name="user_id" id="user_id" class="form-control"
                                        readonly required>
                                    </br>
                                    <label for="title">Title <span class="red">*</span></label>
                                    <input type="text" name="title" value="{{ $project->title }}" class="form-control" id="title"
                                        autofocus required>
                                    </br>
                                    <label for="description">Description <span class="red">*</span></label>
                                    <textarea name="description" class="form-control" id="description" required>{{ $project->description }}</textarea>
                                    </br>
                                    <input type="submit" class="btn btn-success">
                                </form>
                            </div>
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
        {{ $projects->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
@endsection
