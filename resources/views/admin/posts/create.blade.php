@extends('adminlte::page')

@section('title', 'Create Post')

@section('content_header')
    <h1>Create Post</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.posts.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            @include('admin.posts.form')

            <button class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('admin.posts.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>
</div>

@endsection