@extends('layout.master')
@section('title')
    <title>User edit</title>
@endsection
@section('link')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection
@section('content')
    <div class="container center">
        <div class="row m-40 m-10">
            <div class="row create">
                <div class="right">
                <form action="{{ route('users.index') }}" method='GET' target='_blank'>
                    @csrf
                    <button class="btn btn-primary right" type="submit">Back</button>
                </form>
                </div>
            </div>
            <div class="col">
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
        </div>
    </div>
@endsection
