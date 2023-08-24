@extends('layouts.frontend')
@section('content')

</div>
 <main class="container">
  <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
    </div>
  </div>

  <div class="row mb-2">

  @foreach( $posts as $post )

  <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        <img src="{{asset('images/' . $post->image)}}" class="img-thumbnail" alt="Thumbnail">
          <h3 class="mb-0">{{$post->title}}</h3>
          <div class="mb-1 text-muted">{{date('Y-m-d', strtotime($post->created_at))}}</div>
          <p class="card-text mb-auto">{{$post->description}}</p>
          <a href="{{ route('posts.show', $post->id)}}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>

        </div>
      </div>
    </div>

  @endforeach
   
    
  </div> 



</main> 


@endsection