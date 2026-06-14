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
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Create Date</th>
                <th>Post date</th>
                <th width="180">Action</th>
            </tr>
            </thead>

            <tbody>

            @foreach($posts as $post)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($post->featured_image)
                            <img
                                src="{{ asset('storage/' . $post->featured_image) }}"
                                width="80"
                                class="img-thumbnail"
                            >
                        @endif
                    </td>

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
                        {{ $post->created_at->format('d M Y') }}
                    </td>

                    <td>
                            {{ $post->published_at?->format('d M Y') }}
                    </td>

                    <td>

                        <a href="{{ route('admin.posts.edit', $post) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        {{ $posts->links() }}

    </div>

</div>

@endsection


@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)

@section('js')
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    document.querySelectorAll('.delete-btn').forEach((button) => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This post will be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection