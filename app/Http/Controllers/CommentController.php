<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentNotification;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function index($id)
    {
        $post = Post::find($id);

        if(!$post)
        {
            return response([
                'message' => 'Post not Found.'
            ], 403);
        }

        return response([
            'comments' => $post->comments()->with('user:id,name,image')->get()
        ], 200);
    } 

    public function store(Request $request, $id)
    {
         $post = Post::find($id);
    

        if(!$post)
        {
            return response([
                'message' => 'Post not Found.'
            ], 403);
        } 

         $attrs = $request -> validate([
            'comment' => 'required|string',
            

        ]); 
     

        
        Comment::create([
         'user_id' => Auth::user()->id,
            'post_id' => $id,
            'comment' => $attrs['comment']
            
        ]);

        $data = ['name' => Auth::user()->name, 'data' =>$attrs['comment']];
    $user = ['to' => Auth::user()->email]; 

Mail::send('email', $data, function ($message) use ($user) {
    $message->to($user['to'])       
    ->subject("Comment post"); 
});

        return back();
        

    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if(!$comment)
        {
            return response([
                'message' => 'comment not Found.'
            ], 403);
        }

        if($comment->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permisiion denied.'
            ], 403);
        }

        $attrs = $request -> validate([
            'comment' => 'required|string'
        ]);

        $comment->update([
            'comment' => $attrs['comment']
        ]);

        return back();


    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if(!$comment)
        {
            return response([
                'message' => 'comment not Found.'
            ], 403);
        }

        if($comment->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permisiion denied.'
            ], 403);
        }

        $comment->delete();

        return back();
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.editcomment', compact('comment'));

    }

}
