@extends('layouts.main')

@section('title',"post list")

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Published At</th>
  
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
        <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->published_at }}</td>
            <td>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Show</a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection