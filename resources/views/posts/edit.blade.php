@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Edit Post</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Important for specifying an HTTP PUT request -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>
            <div class="form-group">
                <label for="user_id">Author</label>
                <select class="form-control" id="user_id" name="user_id">
                    @foreach($users as $user)
                    <!-- Check and select the option if it matches the post's user_id -->
                    <option value="{{ $user->id }}" @if($user->id == $post->user_id) selected @endif>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="3" required>{{ $post->body }}</textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="enabled" name="enabled" @if($post->enabled) checked @endif>
                <label class="form-check-label" for="enabled">Enabled</label>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
