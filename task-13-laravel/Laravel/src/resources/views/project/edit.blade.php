@extends('layout.master')
@section('title')
    <title>Edit Project</title>
@endsection
@section('link')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection
@section('content')
    <div class="container center">
        <div class="row  m-40 m-10">
            <div class="row create">
                <div class="right">
                <form action="{{ route('projects.show', $project->user_id) }}" method='GET'>
                    @csrf
                    <button class="btn btn-primary right" type="submit">Back</button>
                </form>
                </div>
            </div>
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
    </div>
@endsection
