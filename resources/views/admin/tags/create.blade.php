@extends('adminlte::page')

@section('title', 'Create Tag')

@section('content_header')
    <h1>Create Tag</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf

            @include('admin.tags.form')

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@endsection