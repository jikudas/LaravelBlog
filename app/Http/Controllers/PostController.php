<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    public function WritePost() {
        $category = DB::table('categories') -> get();
        return view('post.WritePost', compact('category'));
    }

    public function StorePost(Request $request) {
        $validatedData = $request -> validate([
            'title' => 'required|max:200',
            'details' => 'required',
            'image' => 'required|mimes:jpeg, jpg, png, PNG|max:1000'
        ]);

        $data = array();
        $data['title'] = $request -> title;
        $data['category_id'] = $request -> category_id;
        $data['details'] = $request -> details;
        $image = $request -> file ('image');

        if($image) {
            $img_name = hexdec(uniqid());
            $ext = strtolower($image -> getClientOriginalExtension());
            $img_full_name = $img_name. '.' .$ext;
            $upload_path = 'public/frontend/image/';
            $image_url = 'public/frontend/image/' . $img_full_name;
            $success = $image -> move($upload_path, $img_full_name);
            $data['image'] = $image_url;
            DB::table('posts') -> insert($data);
            $notification = array(
                'message' => 'Successfully Post Inserted!',
                'alert-type' => 'success'
            );
            return Redirect() -> back() -> with($notification);
        }
        else {
            DB::table('posts') -> insert($data);
            $notification = array(
                'message' => 'Successfully Post Inserted!',
                'alert-type' => 'success'
            );
            return Redirect() -> back() -> with($notification);
        }
    }

    public function AllPost() {
        $post = DB::table('posts')
            -> join('categories', 'posts.category_id', 'categories.id')
            -> select('posts.*', 'categories.name')
            -> get();
        return view ('post.All_Post', compact('post'));
    }

    public function ViewPost($id) {
        $post = DB::table('posts')
            -> join('categories', 'posts.category_id', 'categories.id')
            -> select('posts.*', 'categories.name')
            -> where('posts.id', $id)
            -> first();
        return view('post.View_Post', compact('post'));
    }

    public function EditPost($id)
    {
        $category = DB::table('categories') -> get();
        $post = DB::table('posts') -> where('id', $id) -> first();

        return view('post.Edit_Post', compact('category', 'post'));
    }

    public function UpdatePost(Request $request, $id)
    {
        /*$validatedData = $request -> validate([
            'title' => 'required|max:200',
            'details' => 'required',
            'image' => 'mimes:jpeg, jpg, png, PNG|max:1000'
        ]);

        $data = array();
        $data['title'] = $request->title;
        $data['category_id'] = $request-> category_id;
        $data['details'] = $request->details;
        $image = $request->file('image');

        if ($image) {
            $img_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $img_full_name = $img_name . '.' . $ext;
            $upload_path = 'public/frontend/image/';
            $image_url = 'public/frontend/image/' . $img_full_name;
            $success = $image->move($upload_path, $img_full_name);
            $data['image'] = $image_url;
            unlink($request->old_photo);

            DB::table('posts') -> where('id', $id) -> update($data);
            $notification = array(
                'message' => 'Successfully Post Updated!',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }
        else {
            $data['image'] = $request->old_photo;
            DB::table('posts')->where('id', $id)->update($data);
            $notification = array(
                'message' => 'Successfully Post Updated!',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }*/
    }

    public  function DeletePost($id)
    {
        $post = DB::table('posts') -> where('id',$id) -> first();
        $image = $post -> image;
        return response() -> json($image);
        /*$delete = DB::table('posts') -> where('id', $id) -> delete();

        if($delete)
        {
            $notification = array(
                'message' => 'Successfully Post Deleted!',
                'alert-type' => 'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'Something Went Wrong!',
                'alert-type' => 'error'
            );
            return Redirect()->route('all.post')->with($notification);
        }*/
    }
}