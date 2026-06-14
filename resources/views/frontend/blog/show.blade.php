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

           {{-- latest comments --}}

            @if($comments->count())

    <div class="blog-card mt-4">

        <h3 class="mb-4">
            Comments ({{ $comments->count() }})
        </h3>

        @foreach($comments as $comment)

            <div class="mb-4 border-bottom pb-3">

                <h5 class="mb-1">
                    {{ $comment->name }}
                </h5>

                <small class="text-muted">
                    {{ $comment->created_at->format('d M Y') }}
                </small>

                <p class="mt-2 mb-0">
                    {{ $comment->message }}
                </p>

                        </div>

                    @endforeach

            </div>

        @endif


          {{-- Comment Box --}}

          <div class="blog-card mt-4">
           <h3>Leave a Comment</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Comment</label>
                    <textarea name="message" rows="4" class="form-control">{{ old('message') }}</textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-dark">
                    Submit Comment
                </button>
            </form>
        </div>

    </div>

    <div class="col-lg-4">
        @include('frontend.partials.sidebar')
    </div>

</div>

@endsection