<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Testing\Fluent\Concerns\Has;

class BlogController extends Controller
{
        //control panel
    public function addBlog()
    {
        return view("add-blog");
    }

    public function createBlog(request $request)
    {
        $validate = $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);

        $blog  = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->user_id = auth()->user()->id;
        $blog->save();
        return back()->with('blog_created','Blog has been created successfully');

    }

    public function getBlog(){
        $blogs = Blog::where('user_id',auth()->user()->id)->paginate(3);
        return view('blogs',compact('blogs'));
    }

    public function getBlogById($id){
        $blog = Blog::where('id',$id)->first();
        return view('single-blog',compact('blog'));
    }

    public function deleteBlog($id){
        Blog::where('id',$id)->delete();
        return back()->with('blog_deleted','Blog has been deleted successfully');
    }

    public function editBlog($id){
        $blog = Blog::find($id);
        if(auth()->user()->id != $blog->user_id){
            abort(403);
        }
        return view('edit-blog',compact('blog'));
    }

    public function updateBlog(request $request)
    {
        $validate = $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);
        $blog  = Blog::find($request->id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save();
        return back()->with('blog_updated','Blog has been updated successfully');

    }

    public function dashboard(){
        $input = ['loggedUserinfo'=>Admin::where('id','=',session('LoggedUser'))->first()];
        return view('dashboard');
    }
    
    public function blogHome(){
         $blogs = Blog::paginate(3);
         return view('home',compact('blogs'));
    }

}
