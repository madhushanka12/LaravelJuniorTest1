@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('posts.store')}}" enctype="multipart/form-data">
                        @csrf
             <div class="mb-3">
                 <label>Post Title</label>
                 <input type="text" name="title" class="form-control">
    
                </div>
                <div class="mb-3">
                 <label>Post Description</label>
                 <textarea name="description" class="form-control" rows="7"></textarea>
    
                </div>
                <div class="form-group">
                    <input class="form-control" name="image" type="file">

                </div>
 
                <button type="submit" class="btn btn-primary">Posts</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
