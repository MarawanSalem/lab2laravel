@extends('layouts.main')

@section('content')
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required><br>
        <input type="submit" value="Submit">
    </form>
@endsection
