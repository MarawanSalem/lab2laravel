{{-- resources/views/users/index.blade.php --}}
@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Users</h1>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }} - {{ $user->email }}
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-sm btn-danger">delete</a>
            </li>

        @endforeach
    </ul>
</div>
@endsection


