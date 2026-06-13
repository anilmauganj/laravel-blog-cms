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

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection