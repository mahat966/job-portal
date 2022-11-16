<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function addBlog()
    {
        return view("add-blog");
    }

    public function createBlog(request $request)
    {
        $blog  = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save();
        return back()->with('blog_created','Blog has been created successfully');

    }

    public function getBlog(){
        $blogs = Blog::orderBy('id')->get();
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
        return view('edit-blog',compact('blog'));
    }

    public function updateBlog(request $request)
    {
        $blog  = Blog::find($request->id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save();
        return back()->with('blog_updated','Blog has been updated successfully');

    }
}
