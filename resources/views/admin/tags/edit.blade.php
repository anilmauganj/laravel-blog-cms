@extends('adminlte::page')

@section('title', 'Edit Tag')

@section('content_header')
    <h1>Edit Tag</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.tags.form')

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@endsection