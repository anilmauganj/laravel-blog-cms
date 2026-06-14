@extends('adminlte::page')

@section('title', 'Tags')

@section('content_header')
    <h1>Tags</h1>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
            Add Tag
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>
                            @if($tag->status)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-sm btn-danger delete-btn">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tags->links() }}
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
            let form = this.closest('.delete-form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This tag will be deleted.',
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