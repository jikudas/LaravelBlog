@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <a class="btn btn-danger" href="{{url('add.category')}}">Add Category</a>
                <a class="btn btn-info" href="{{url('all.category')}}">All Category</a>
                <hr>
                <table class="table table-responsive">
                    <tr>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Slug Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @foreach($category as $row)
                    <tr>
                        <td>{{$row -> id}}</td>
                        <td>{{$row -> name}}</td>
                        <td>{{$row -> slug}}</td>
                        <td>{{$row -> created_at}}</td>
                        <td>
                            <a href="{{url('edit/category/' . $row -> id)}}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{url('delete/category/' . $row -> id )}}" class="btn btn-sm btn-danger">Delete</a>
                            <a href="{{url('view/category/'. $row -> id)}}" class="btn btn-sm btn-success">View</a>
                        </a>
                    </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection