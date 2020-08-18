@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <a class="btn btn-danger" href="{{URL::to('student/create')}}">Add Student</a>
                <hr>
                <table class="table table-responsive">
                    <tr>
                        <th>SL</th>
                        <th>Student Name</th>
                        <th>Student Phone</th>
                        <th>Student Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach($student as $row)
                        <tr>
                            <td>{{$row -> id}}</td>
                            <td>{{$row -> name}}</td>
                            <td>{{$row -> phone}}</td>
                            <td>{{$row -> email}}</td>
                            <td>
                                <td><a href="{{url('student/' . $row -> id . '/edit')}}" class="btn btn-sm btn-info">Edit</a></td>
                                <td>
                                    <form action="{{url('student/'. $row -> id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                                <td><a href="{{url('student/'. $row -> id)}}" class="btn btn-sm btn-success">View</a></td>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection