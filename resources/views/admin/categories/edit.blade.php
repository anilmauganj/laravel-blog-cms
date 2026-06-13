@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content_header')
    <h1>Edit Category</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.categories.form')

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@endsection