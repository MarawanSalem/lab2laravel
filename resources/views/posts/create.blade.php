@extends('layouts.main')
@section('title', 'Add new post')
@section('content')

<div class="container">
    <h1>Add New Post</h1>
    <form action="{{ url('/posts') }}" method="post">
        @csrf
     
      

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control">
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Publish At</label>
            <input type="date" name="published_at" id="published_at" class="form-control">
        </div>
        <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="enabled" name="enabled">
                <label class="form-check-label" for="enabled">Enabled</label>
            </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection
