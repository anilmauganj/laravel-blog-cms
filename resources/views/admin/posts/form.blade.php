<div class="form-group mb-3">
    <label>Category</label>

    <select name="category_id" class="form-control">
        <option value="">Select Category</option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                {{ old('category_id', optional($post ?? null)->category_id) == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>Title</label>

    <input
        type="text"
        name="title"
        class="form-control"
        value="{{ old('title', optional($post ?? null)->title) }}"
    >

    @error('title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>Excerpt</label>

    <textarea
        name="excerpt"
        rows="3"
        class="form-control"
    >{{ old('excerpt', optional($post ?? null)->excerpt) }}</textarea>

    @error('excerpt')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>Content</label>

    <textarea
        name="content"
        rows="30"
        class="form-control"
          id="content"
    >{{ old('content', optional($post ?? null)->content) }}</textarea>

    @error('content')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>Featured Image</label>

    <input
        type="file"
        name="featured_image"
        class="form-control"
    >

    @if(optional($post ?? null)->featured_image)
        <div class="mt-2">
            <img
                src="{{ asset('storage/' . $post->featured_image) }}"
                width="150"
                class="img-thumbnail"
            >
        </div>
    @endif

    @error('featured_image')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>Status</label>

    <select name="status" class="form-control">

        <option value="draft"
            {{ old('status', optional($post ?? null)->status ?? 'draft') == 'draft' ? 'selected' : '' }}>
            Draft
        </option>

        <option value="published"
            {{ old('status', optional($post ?? null)->status ?? 'draft') == 'published' ? 'selected' : '' }}>
            Published
        </option>

    </select>

    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>SEO Title</label>

    <input
        type="text"
        name="seo_title"
        class="form-control"
        value="{{ old('seo_title', optional($post ?? null)->seo_title) }}"
    >

    @error('seo_title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group mb-3">
    <label>Meta Description</label>

    <textarea
        name="meta_description"
        rows="3"
        class="form-control"
       
    >{{ old('meta_description', optional($post ?? null)->meta_description) }}</textarea>

    @error('meta_description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>