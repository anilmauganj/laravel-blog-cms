@extends('adminlte::page')

@section('title', 'Create Category')

@section('content_header')
    <h1>Create Category</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            @include('admin.categories.form')

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@endsection