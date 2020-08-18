@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <a class="btn btn-danger" href="{{url('add.category')}}">Add Category</a>
                <a class="btn btn-info" href="{{url('all.category')}}">All Category</a>
                <a class="btn btn-info" href="{{route('all.post')}}">All Post</a>
                <hr>
                @if($errors -> any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors -> all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                        </ul>
                    </div>
                    @endif

                <form action="{{url('store.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Post Title</label>
                            <input type="text" class="form-control" placeholder="Post Title" required name="title">
                        </div>
                    </div>

                    <br>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Category Name</label>
                            <select class="form-control" name="category_id">
                                @foreach($category as $row)
                                <option value="{{$row -> id}}">{{$row -> name}}</option>
                                    @endforeach
                            </select>

                        </div>
                    </div>

                    <br>

                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Post Details</label>
                            <textarea rows="5" class="form-control" placeholder="Post Dtails" required name="details"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Post Image</label>
                            <input type="file" class="form-control" placeholder="Image" name="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endsection