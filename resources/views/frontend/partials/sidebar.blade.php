<div class="sidebar-widget">

    <h3>Search</h3>

 <form action="{{ route('blog.search') }}" method="GET">

    <input
        type="text"
        name="q"
        class="form-control mb-3"
        placeholder="Search posts..."
        value="{{ request('q') }}"
    >

    <button class="btn btn-dark">
        Search
    </button>

  </form>

</div>



<div class="sidebar-widget">

    <h3>Categories</h3>

    <ul class="sidebar-list">

        @foreach($categories as $category)

            <li>

                <a href="{{ route('category.show', $category->slug) }}">
                    {{ $category->name }}
                </a>

            </li>

        @endforeach

    </ul>

</div>



<div class="sidebar-widget">

    <h3>Recent Posts</h3>

    <ul class="sidebar-list">

        @foreach($recentPosts as $recentPost)

            <li>

                <a href="{{ route('blog.show', $recentPost->slug) }}">
                    {{ $recentPost->title }}
                </a>

            </li>

        @endforeach

    </ul>

</div>