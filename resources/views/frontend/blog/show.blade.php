@extends('frontend.layouts.app')

@section('title', $post->seo_title ?: $post->title)

@section('meta_description', $post->meta_description)

@section('content')

<div class="row">

    <div class="col-lg-8 mx-auto">

        <h1 class="mb-3">
            {{ $post->title }}
        </h1>

        <div class="mb-3 text-muted">

            <strong>Category:</strong>

            <a href="{{ route('category.show', $post->category->slug) }}">
                {{ $post->category->name }}
            </a>

            |

            <strong>Views:</strong>
            {{ $post->views }}

        </div>

        @if($post->featured_image)

            <div class="mb-4">

                <img
                    src="{{ asset('storage/' . $post->featured_image) }}"
                    class="img-fluid rounded"
                    alt="{{ $post->title }}"
                >

            </div>

        @endif

        @if($post->excerpt)

            <div class="alert alert-light">
                {{ $post->excerpt }}
            </div>

        @endif

        <div>

            {!! $post->content !!}

        </div>

    </div>

</div>

@endsection