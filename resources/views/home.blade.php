@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Homepage</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tasto Logout -->
    @auth
    <form action="{{ route('logoutUser') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    @endauth
</div>
@endsection
