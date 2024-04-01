@extends('layout.master')
@section('title')
    <title>Create User</title>
@endsection
@section('link')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection
@section('content')
    <div class="container center">
        <div class="row  m-40 m-10">
            <div class="row create">
                <div class="right">
                    <form action="{{ route('users.index') }}" method='GET'>
                        @csrf
                        <button class="btn btn-primary right" type="submit">Back</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <form method="post" action="{{ route('users.store') }}">
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
                </form>
            </div>
        </div>
    </div>
@endsection
