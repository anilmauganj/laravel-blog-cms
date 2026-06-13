@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit Post</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.posts.update', $post) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('admin.posts.form')

            <button class="btn btn-primary">
                Update
            </button>

        </form>

    </div>
</div>

@endsection