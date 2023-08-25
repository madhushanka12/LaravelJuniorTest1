@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('comments.update', $comment->id)}}">
  @csrf

  <div class="card my-5">
      <h5 class="card-header">Update Comment</h5>
      <div class="card-body">
        <form method="post" action="">
          <textarea name="comment" class="form-control"></textarea>
          <button type="update" class="btn btn-danger">Update</button>
</div>
</div> 
</form>
@endsection