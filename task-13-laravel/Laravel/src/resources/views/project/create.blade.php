@extends('layout.master')
@section('title')
    <title>Create Project</title>
@endsection
@section('link')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection
@section('content')
    <div class="container center">
        <div class="row  m-40 m-10">
            <div class="row create">
                <div class="right">
                    <form action="{{ route('projects.index') }}" method='GET'>
                        @csrf
                        <button class="btn btn-primary right" type="submit">Back</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <form method="post" action="{{ route('projects.store') }}">
                    @csrf
                    </br>
                    <label for="user_id">User Id <span class="red">*</span></label>
                    <input type="number" name="user_id" value="{{ $user_id ?? '' }}" id="user_id" class="form-control"
                        autofocus required>
                    </br>
                    <label for="title">Title <span class="red">*</span></label>
                    <input type="text" name="title" class="form-control" id="title" required>
                    </br>
                    <label for="description">Description <span class="red">*</span></label>
                    <textarea name="description" class="form-control" id="description" required></textarea>
                    </br>
                    <input type="submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection
