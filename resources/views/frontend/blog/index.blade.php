

@extends('frontend.layouts.app')



@section('content')

<div class="row">

    {{-- Left Content --}}
    <div class="col-lg-8">

         @if(isset($category))
            <div class="category-header mb-4">
                <h1 class="mb-2">
                    {{ $category->name }}
                </h1>

                <p class="text-muted mb-0">
                    Showing posts from <strong>{{ $category->name }}</strong> category.
                    Total posts: <strong>{{ $posts->total() }}</strong>
                </p>
            </div>
        @endif

        {{-- Search Result --}}
         
          @if(isset($search))

                <div class="category-header mb-4">

                    <h1 class="mb-2">
                        Search Results
                    </h1>

                    <p class="text-muted mb-0">

                        Showing results for:

                        <strong>
                            {{ $search }}
                        </strong>

                    </p>

                </div>

            @endif

        {{-- End Search Result --}}

        @forelse($posts as $post)

            <div class="blog-card">

                <div class="row">

                    <div class="col-md-5">

                        @if($post->featured_image)

                            <img
                                src="{{ asset('storage/' . $post->featured_image) }}"
                                class="blog-thumb"
                                alt="{{ $post->title }}"
                            >

                        @endif

                    </div>

                    <div class="col-md-7">

                        <h2 class="blog-title">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <div class="blog-meta">

                            @if($post->published_at)
                                {{ $post->published_at->format('d M Y') }}
                            @endif

                            &nbsp; | &nbsp;

                            {{ $post->category->name }}

                        </div>

                        <p>
                            {{ \Illuminate\Support\Str::limit(
                                $post->excerpt ?: strip_tags($post->content),
                                150
                            ) }}
                        </p>

                        <a
                            href="{{ route('blog.show', $post->slug) }}"
                            class="read-more-btn"
                        >
                            Read More
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="alert alert-info">
                No posts found.
            </div>

        @endforelse

        {{ $posts->links() }}

    </div>


    {{-- Sidebar --}}
    <div class="col-lg-4">

        @include('frontend.partials.sidebar')

    </div>

</div>

@endsection