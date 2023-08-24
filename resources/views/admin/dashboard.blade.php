@extends('layouts.admin')

@section('content')


<li class="nav-item">
                        <a class="nav-link" href="{{ route('home')}}">New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.all')}}">All Post</a>
                    </li>
@endsection