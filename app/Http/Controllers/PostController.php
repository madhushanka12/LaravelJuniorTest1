<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
   
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($validator->fails()) {
        return back()->with('status', 'Something went wrong!')
                     ->withErrors($validator)
                     ->withInput();
    } else {
        $imageName = time() . "." . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imageName
        ]);

        return back()->with('status', 'Post created successfully!');
    }
}


    public function show($postId)
    {
            $post = Post::findOrFail($postId);
            return view('posts.show', compact('post'));
    }

    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        return view('posts.edit', compact('post'));

    }


    public function update($postId, Request $request)
    {
        Post::findOrFail($postId)->update($request->all());

        return redirect(route('posts.all'));
    }

    public function delete($postId)
    {
        Post::findOrFail($postId)->delete();
        return redirect(route('posts.all'));

        
          
    }
}
