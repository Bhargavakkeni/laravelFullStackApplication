@extends('layout.master')

@section('title')
    <title>Projects</title>
@endsection

@section('link')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container center mt-25">
        <div class="row create">
            <div class="col">
                <form action="{{ route('projects.create') }}" method='GET' target="_blank">
                    @csrf
                    <button class="btn btn-success right m-1" type="submit">Create</button>
                </form>
                <form action="{{ route('users.index') }}" method='GET' target="_blank">
                    @csrf
                    <button class="btn btn-primary right m-1" type="submit">Users</button>
                </form>
            </div>
        </div>
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
    <div class="pageLinks d-flex">
        {{ $projects->links() }}
    </div>
@endsection
@section('script')
    <script src="{{ asset('scripts/view.js') }}"></script>
@endsection
