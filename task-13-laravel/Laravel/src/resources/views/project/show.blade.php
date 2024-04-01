@extends('layout.master')
@section('title')
    <title>Projects</title>
@endsection
@section('link')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Projects Details</h1>
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
    <div class="container center mt-25">
        <div class="row create">
            <form action="{{ route('projects.create') }}" method='GET' target="_blank">
                @csrf
                <button class="btn btn-success right" type="submit">Create</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="userTable">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">user_id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project_array as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->user_id }}</td>
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
                                <form action="{{ route('projects.edit', $project->id) }}" method='GET' target="_blank">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
@endsection
