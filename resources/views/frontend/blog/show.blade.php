@extends('frontend.layouts.app')

@section('title', $post->seo_title ?: $post->title)
@section('meta_description', $post->meta_description)

@section('content')

<div class="row">

    <div class="col-lg-8">

        <article class="blog-card">

            <h1 class="blog-title">
                {{ $post->title }}
            </h1>

            <div class="blog-meta">
                @if($post->published_at)
                    {{ $post->published_at->format('d M Y') }}
                @endif

                &nbsp; | &nbsp;

                <a href="{{ route('category.show', $post->category->slug) }}">
                    {{ $post->category->name }}
                </a>

                &nbsp; | &nbsp;

                {{ $post->views }} views
            </div>

            @if($post->featured_image)
                <img
                    src="{{ asset('storage/' . $post->featured_image) }}"
                    class="single-post-image mb-4"
                    alt="{{ $post->title }}"
                >
            @endif

            @if($post->excerpt)
                <p class="lead">
                    {{ $post->excerpt }}
                </p>
            @endif

            <div class="post-content">
                {!! $post->content !!}
            </div>

        </article>

    </div>

    <div class="col-lg-4">
        @include('frontend.partials.sidebar')
    </div>

</div>

@endsection