@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Posts Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->posts_count }}</td>
                <td>
                    <div class="d-flex">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Edit</a>
                    <form action="{{ route('users.destroy' , $user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center"> {{ $users->links() }}</div>

@endsection
