<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\LikeDislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public Function save_like(Request $request)
    {
        if (!Auth::check())
        {
            return response()->json([
                "status" => false,
                "message" => "User Not Logged In"
            ]);
        }

        $likeCheck = LikeDislike::where('blog_id', $request->post)->where('user_id', auth()->user()->id)->first();
        if ($request->type == "like") {
            if ($likeCheck) {
                $likeCheck->like = !$likeCheck->like;
                $likeCheck->save();

            } else {
                $likeCheck = new LikeDislike;
                $likeCheck->blog_id = $request->post;
                $likeCheck->user_id = auth()->user()->id;
                $likeCheck->like = 1;
                $likeCheck->save();
            }
        }else{
            if ($likeCheck) {
                $likeCheck->dislike = !$likeCheck->dislike;
                $likeCheck->save();

            } else {
                $likeCheck = new LikeDislike;
                $likeCheck->blog_id = $request->post;
                $likeCheck->user_id = auth()->user()->id;
                $likeCheck->dislike = 1;
                $likeCheck->save();
            } 
        }

        
          
        return response()->json([
            'status'=>true,
            'like' => $likeCheck->blog->likes(),
            'dislike' => $likeCheck->blog->dislikes(),

        ]);
        


    }
}
    