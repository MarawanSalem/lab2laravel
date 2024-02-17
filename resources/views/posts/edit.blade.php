@extends('layouts.main')
@section('title',"edit post")
@section('content')

<div class="container">
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <select name="user_id" id="user_id" class="form-select">
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control" >{{ $post->body }}</textarea>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $post->slug }}">
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Publish At</label>
            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ $post->published_at }}">
        </div>
        <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="enabled" name="enabled" {{ $post->enabled ? 'checked' : '' }}>
                <label class="form-check-label" for="enabled">Enabled</label>
            </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
