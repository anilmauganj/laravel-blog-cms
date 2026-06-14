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
       
         {{-- Post tags --}}
         @if($post->tags->count())

                <div class="mt-4">

                    <strong>Tags:</strong>

                    @foreach($post->tags as $tag)

                        <a
                            href="{{ route('tag.show', $tag->slug) }}"
                            class="badge bg-secondary text-decoration-none"
                        >
                            {{ $tag->name }}
                        </a>

                    @endforeach

                </div>

            @endif

        {{-- Next Prev Post --}}

        <div class="blog-card mt-4">
       <div class="d-flex justify-content-between">

        <div>
            @if($previousPost)
                <a href="{{ route('blog.show', $previousPost->slug) }}">
                    ← {{ $previousPost->title }}
                </a>
            @endif
        </div>

            <div>
                @if($nextPost)
                    <a href="{{ route('blog.show', $nextPost->slug) }}">
                        {{ $nextPost->title }} →
                    </a>
                @endif
            </div>

        </div>
     </div>

        {{-- Related Posts --}}
        @if($relatedPosts->count())
        <div class="blog-card mt-4">
            <h3 class="mb-4">Related Posts</h3>

            @foreach($relatedPosts as $relatedPost)
                <div class="mb-3">
                            <h5>
                                <a href="{{ route('blog.show', $relatedPost->slug) }}">
                                    {{ $relatedPost->title }}
                                </a>
                            </h5>

                            <p class="text-muted mb-1">
                                {{ $relatedPost->category->name }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif

    </div>

    <div class="col-lg-4">
        @include('frontend.partials.sidebar')
    </div>

</div>

@endsection