@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add New Post</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->published_at }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
</div>
@endsection
