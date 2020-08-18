<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();

        return view('student.index', compact('student'));
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|max:25|min:4',
            'phone' => 'required|unique:students|max:12|min:9',
            'email' => 'required|unique:students',
        ]);

        $student = new Student;
        $student -> name = $request -> name;
        $student -> email = $request -> email;
        $student -> phone = $request -> phone;
        $student -> save();
        $notification = array(
            'message' => 'Successfully Done!',
            'alert-type' => 'success'
        );
        return Redirect() -> back() -> with($notification);
    }

    public function show($id)
    {
        //DB::table('students') -> where('id', $id) -> first();
        $student = Student::findorfail($id);
        return response() -> json($student);
    }

    public function edit($id)
    {
        $student = Student::findorfail($id);
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findorfail($id);
        $student -> name = $request -> name;
        $student -> email = $request -> email;
        $student -> phone = $request -> phone;
        $student -> save();
        $notification = array(
            'message' => 'Successfully Updated!',
            'alert-type' => 'info'
        );
        return Redirect() -> route('all.student') -> with($notification);
    }

    public function destroy($id)
    {
        $student = Student::findorfail($id);
        $student -> delete();

        //DB::table('students') -> where('id', $id) -> delete();

        $notification = array(
            'message' => 'Successfully Deleted!',
            'alert-type' => 'success'
        );
        return Redirect() -> back() -> with($notification);
    }
}
