{{--@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->email }}</td>
            <td>
                <form action="{{ route('users.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('users.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {{ $users->links() }}


@endsection--}}


@extends('layout.master')
@section('link')
<link href="{{asset('css/index.css')}}" rel="stylesheet">
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
  <div class="container center mt-25">
    <div class="row create">
    <form action="{{route('users.create')}}" method='GET'>
                    @csrf
                    <button class="btn btn-success right" type="submit">Create</button>
            </form>
    </div>
    <table class="table table-hover" id="userTable">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <form action="{{route('users.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form> 
            </td>
            <td>
                <form action="{{route('users.edit', $user->id)}}" method='GET'>
                    @csrf
                    <button class="btn btn-warning" type="submit">Edit</button>
                </form>
            </td>
            <td>               
                <button class="btn btn-primary" type="submit" onclick="return handleAction({{$user->id}})" data-bs-toggle="modal" data-bs-target="#Modal">view</button>            
            </td>
            <td>               
                <a href="http://localhost:8000/api/host/projects/{{ $user->id }}" class="btn btn-primary" target="_blank">Projects</a>            
            </td>
        </tr>
        @endforeach
    </tbody>
     
    </table>
    <!--<div class="row">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="pagination">
          <li class="page-item disabled" id="prevEnable">
            <a class="page-link" href="#" onclick="return handlePage('previous')" id="previous">Previous</a>
          </li>
          <li class="page-item" id="nexEnable">
            <a class="page-link" href="#" onclick="return handlePage('next')" id="next">Next</a>
          </li>
        </ul>
      </nav>
    </div>-->
  </div>
{{ $users->links() }}
@endsection
@section('script')
<script src="{{asset('scripts/view.js')}}"></script>
@endsection


