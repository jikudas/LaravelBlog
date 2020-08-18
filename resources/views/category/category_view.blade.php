@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <a class="btn btn-danger" href="{{url('add.category')}}">Add Category</a>
                <a class="btn btn-info" href="{{url('all.category')}}">All Category</a>
                <hr>
                <div>
                    <ol>
                        <li>Category Name : {{$cat -> name}}</li>
                        <li>Slug Name : {{$cat -> slug}}</li>
                        <li>Created_At : {{$cat -> created_at}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection