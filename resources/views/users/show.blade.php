{{-- resources/views/show.blade.php --}}
@extends('layouts.main')

@section('content')
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @else
        <p>{{ $message ?? 'Default message if none provided' }}</p>
    @endif

@endsection
