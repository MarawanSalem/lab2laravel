@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    Post Details
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
    <h6 class="card-subtitle mb-2 text-muted">By: {{ $post->user->name }}</h6>
    <p class="card-text">{{ $post->body }}</p>
    <a href="{{ route('posts.index') }}" class="card-link">Back to all posts</a>
  </div>
</div>
@endsection
