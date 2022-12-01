<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(request $request){
        if(Auth::check())
        {
            $validator = Validator::make($request->all(),[
                'comment_body' => 'required|string'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->with('Status','Comment area is mandatory');
            }
            $blog = Blog::where('id', $request->blog_id)->first();
            if($blog)
            {
                Comment::Create([
                    'blog_id' => $blog->id,
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);
                return redirect()->back()->with('Status','Commented successfully');

            }
            else
            {
            return redirect()->back()->with('Status','no such blog found');
            }
        }
        else{
            return redirect('auth/login')->with('Status','Login first to comment');
        }

    }

    public function deleteComment(request $request)
    {
        $comment = Comment::where('id', $request->comment_id)->where('user_id', auth()->user()->id)->first();
        $comment->delete();
            return response()->json([
                'status' => 200,
                'message' => 'success Deleted Comment'
            ]);
    }

    public function editComment($id){
        $comment = Comment::find($id);
        return response()->json([
            'status'=>200,
            'Comment'=>$comment,
        ]);      
    }

    public function updateComment(Request $request){
        $comnt_id = $request->input('cmt_id');
        $comment = Comment::find($comnt_id);
        $comment->comment_body = $request->input('comment_body');
        $comment->update();
        return redirect()->back()->with('status','Comment updated Successfully');
    }
}
