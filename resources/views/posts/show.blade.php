@extends('layouts.main')
@section('title', 'Post Details')
@section('content')
<div class="container">
    <h2>Post Details</h2>
    <table class="table">
        <tbody>
            <tr>
                <th>Title:</th>
                <td>{{ $post->title }}</td>
            </tr>
            <tr>
                <th>Body:</th>
                <td>{{ $post->body }}</td>
            </tr>
            <tr>
                <th>Slug:</th>
                <td>{{ $post->slug }}</td>
            </tr>
            <tr>
                <th>Published At:</th>
                <td>{{ $post->published_at }}</td>
            </tr>
            <tr>
                <th>Created At:</th>
                <td>{{ $post->created_at }}</td>
            </tr>
        </tbody>
    </table>
    <div  class="d-flex">
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary me-1">Edit</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>
</div>
@endsection