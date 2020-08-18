<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\True_;
use PhpParser\Node\Stmt\Return_;
use DB;

class Category extends Controller
{
    public function AddCategory() {
        return view('category.add_category');
    }

    public function StoreCategory(Request $request) {
        $validatedData = $request -> validate([
            'name' => 'required|unique:categories|max:25|min:4',
            'slug' => 'required|unique:categories|max:25|min:4'
        ]);



        $data = array();
        $data['name'] = $request -> name;
        $data['slug'] = $request -> slug;
        $category = DB::table('categories') -> insert ($data);
        if ($category) {
            $notification = array(
                'message' => 'Successfully Category Inserted!',
                'alert-type' => 'success'
            );
            return Redirect() -> route('all.category') -> with($notification);
        }
        else {
            $notification = array(
                'message' => 'Something Went Wrong!',
                'alert-type' => 'success'
            );
            return Redirect() -> back() -> with($notification);
        }
    }

    public function AllCategory() {
        $category = DB::table('categories') -> get();
        return view('category.all_category', compact('category'));
    }

    public function ViewCategory($id) {
        $view = DB:: table('categories') -> where('id', $id) -> first();
        return view('category.category_view') -> with('cat', $view);
    }

    public function DeleteCategory($id) {
        $delete = DB::table('categories') -> where('id', $id) -> delete();

            $notification = array(
                'message' => 'Successfully Category Deleted!',
                'alert-type' => 'success'
            );
            return Redirect() -> back() -> with($notification);
    }

    public function EditCategory($id) {
        $edit = DB::table('categories') -> where('id', $id) -> first();
        return view('category.edit_category', compact('edit'));
    }

    public function UpdateCategory(Request $request, $id) {
        $validatedData = $request -> validate([
            'name' => 'required|max:25|min:4',
            'slug' => 'required|max:25|min:4'
        ]);

        $data = array();
        $data['name'] = $request -> name;
        $data['slug'] = $request -> slug;
        $edit = DB::table('categories') -> where('id', $id) -> update ($data);
        if ($edit) {
            $notification = array(
                'message' => 'Successfully Category Updated!',
                'alert-type' => 'success'
            );
            return Redirect() -> route('all.category') -> with($notification);
        }
        else {
            $notification = array(
                'message' => 'Nothing to Update!',
                'alert-type' => 'error'
            );
            return Redirect() -> route('all.category') -> with($notification);
        }
    }
}
