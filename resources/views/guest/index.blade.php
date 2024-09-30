@extends('layouts.guest')

@section('content')
    <div class="container text-center my-5">
        <h1>Home page guest</h1>
        <a class="btn btn-danger mt-5" href="{{ route('admin.home') }}">VAI AD ADMIN</a>
    </div>
@endsection
