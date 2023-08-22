<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return response([
            'posts' => Post::orderBy('created_at', 'desc')->with('user:id,name,image')->withCount('comments', 'likes') 
            ->with('likes', function($like){
                return $like->where('user_id', auth()->user()->id)
                    ->select('id', 'user_id', 'post_id')->get();
            })
            ->get()
        ], 200);
    }

    public function show($id)
    {
        return response([
            'post' => Post::where('id', $id) ->withCount('comments', 'likes')->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $attrs = $request -> validate([
            'body' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('posts', 'public'); 
        }

        $post = Post::create([
            'body' => $attrs['body'],
            'user_id' => auth()->user()->id,
            'image' => $image
        ]);

        return response([
            'message' => 'Post created.',
            'post' => $post
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if(!$post)
        {
            return response([
                'message' => 'Post not Found.'
            ], 403);
        }

        if($post->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permisiion denied.'
            ], 403);
        }

        $attrs = $request -> validate([
            'body' => 'required|string'
        ]);

        $post->update([
            'body' => $attrs['body'],
            
        ]);

        return response([
            'message' => 'Post updated.',
            'post' => $post
        ], 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            return response([
                'message' => 'Post not Found.'
            ], 403);
        }

        if($post->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permisiion denied.'
            ], 403);
        }

        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();

        return response([
            'message' => 'Post delete.'
        ], 200);
    }
}
