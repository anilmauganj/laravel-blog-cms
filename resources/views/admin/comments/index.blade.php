@extends('adminlte::page')

@section('title', 'Comments')

@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <h1>Comments</h1>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th width="220">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($comments as $comment)

                    <tr>

                        <td>{{ $comment->name }}</td>

                        <td>{{ $comment->email }}</td>

                        <td>{{ $comment->post->title }}</td>

                        <td>

                            @if($comment->status === 'approved')

                                <span class="badge badge-success">
                                    Approved
                                </span>

                            @else

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($comment->status === 'pending')

                                <form
                                    action="{{ route('admin.comments.approve', $comment) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn btn-success btn-sm">
                                        Approve
                                    </button>

                                </form>

                            @endif

                            <form
                                action="{{ route('admin.comments.destroy', $comment) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        {{ $comments->links() }}

    </div>

</div>

@endsection