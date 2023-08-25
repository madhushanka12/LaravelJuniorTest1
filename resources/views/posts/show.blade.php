@extends('layouts.app')
@section('content')
<head>
<style>
<link href="{{ asset('assets/dist/js/jquery-3.7.0.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}" rel="stylesheet">
</style>
</head>

<div class="card text-center">
  <div class="card-header">
    #{{ $post->id}}
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $post->title}}</h5>
    <p class="card-text">{{ $post->description}}</p>
    <img src="{{asset('images/' . $post->image)}}" class="img-thumbnail" alt="Thumbnail">
  </div>
  <div class="card-footer text-body-secondary">
  {{date('Y-m-d', strtotime($post->created_at))}}
  </div>
  
  <form method="post" action="{{ route('comments.store', $post->id)}}">
  @csrf

  <div class="card my-5">
      <h5 class="card-header">Add Comment</h5>
      <div class="card-body">
        <form method="post" action="">
          <textarea name="comment" class="form-control"></textarea>
          <input type="submit" class="btn btn-dark mt-2"/>
</div>
</div> 
</form>

  @forelse($post->comments as $comment)
  <div class = "card card-body shadow-sm mt-3">
    <div class = "details-are">
      <h6 class ="user-name mb-1">
        @if($comment->user)
        {{$comment->user->name}}
        @endif
        <small class="ms-3 text-primary">Commented on:{{$comment->created_at->format('d-m-y')}}</small>
      </h6>
        <p class="user-comment mb-1">
          {!!$comment->comment!!}
        </p>
 </div>
 @if(Auth::check() && Auth::id() == $comment->user_id)
 <div>
    <a href = "{{route('comments.edit', $comment->id)}}" class="btn btn-primary btn-sm me-2">Edit</a>


    <form method="get" action="{{ route('comments.delete',$comment->id)}}">
  @csrf
  <button type="submit" class="btn btn-danger">DELETE</button>
    </form>
</div>
@endif
</div>
    @empty
    <p>No Comment yet</p>
@endforelse


</div>

