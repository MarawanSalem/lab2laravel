@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
