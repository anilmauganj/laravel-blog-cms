<div class="sidebar-widget">

    <h3>Search</h3>

    <form>

        <input
            type="text"
            class="form-control mb-3"
            placeholder="Search posts..."
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