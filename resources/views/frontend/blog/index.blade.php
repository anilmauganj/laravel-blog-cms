
@php
use Illuminate\Support\Str;
@endphp

@extends('frontend.layouts.app')

@section('title', 'Latest Blog Posts')

@section('content')

<div class="row">

    <div class="col-lg-12">

        <h1 class="mb-4">

            @isset($category)
                {{ $category->name }}
            @else
                Latest Blog Posts
            @endisset

        </h1>

    </div>

</div>


<div class="row">

    @forelse($posts as $post)

        <div class="col-md-4 mb-4">

            <div class="card h-100">

                @if($post->featured_image)

                    <img
                        src="{{ asset('storage/' . $post->featured_image) }}"
                        class="card-img-top"
                        alt="{{ $post->title }}"
                    >

                @endif

                <div class="card-body">

                    <h5 class="card-title">
                        {{ $post->title }}
                    </h5>

                    <p class="text-muted mb-2">

                        <a href="{{ route('category.show', $post->category->slug) }}">
                            {{ $post->category->name }}
                        </a>

                    </p>

                    <p>
                        {{ Str::limit($post->excerpt, 100) }}
                    </p>

                    <a
                        href="{{ route('blog.show', $post->slug) }}"
                        class="btn btn-primary"
                    >
                        Read More
                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info">
                No posts found.
            </div>

        </div>

    @endforelse

</div>


<div class="mt-4">
    {{ $posts->links() }}
</div>

@endsection