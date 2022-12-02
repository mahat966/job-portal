<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentReplyController extends Controller
{
    public function storeReply(request $request){
        if(Auth::check())
        {
            $validator = Validator::make($request->all(),[
                'reply_text' => 'required|string'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->with('Status','Comment area is mandatory');
            }
            $comment = Comment::where('id',$request->comment_id)->first();
            if($comment)
            {
                CommentReply::Create([
                    'comment_id' => $comment->id,
                    'user_id' => Auth::user()->id,
                    'reply_text' => $request->reply_text
                ]);
                return redirect()->back()->with('Status','Commented replied successfully');

            }
            else
            {
            return redirect()->back()->with('Status','no such comment found');
            }
        }
        else{
            return redirect('auth/login')->with('Status','Login first to reply comments');
        }

    }

    public function deleteReply(request $request)
    {
        $reply = CommentReply::where('id', $request->reply_id)->where('user_id', auth()->user()->id)->first();
        dd($reply);
        $reply->delete();
            return response()->json([
                'status' => 200,
                'message' => 'success Deleted Comment'
            ]);
    }
}
