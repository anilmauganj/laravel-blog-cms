@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1>Posts</h1>
@endsection

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('admin.posts.create') }}"
           class="btn btn-primary">
            Add Post
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
            </thead>

            <tbody>

            @foreach($posts as $post)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $post->title }}</td>

                    <td>{{ $post->category->name }}</td>

                    <td>

                        @if($post->status === 'published')

                            <span class="badge badge-success">
                                Published
                            </span>

                        @else

                            <span class="badge badge-warning">
                                Draft
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('admin.posts.edit', $post) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        {{ $posts->links() }}

    </div>

</div>

@endsection