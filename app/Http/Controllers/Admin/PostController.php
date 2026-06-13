<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }


     public function create()
    {
        $categories = Category::where('status', true)->orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }


    public function store(PostRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $imagePath,
            'status' => $request->status,
            'published_at' => $request->status === 'published'
                ? ($request->published_at ?? now())
                : null,
            'seo_title' => $request->seo_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }


     public function edit(Post $post)
    {
        $categories = Category::where('status', true)->orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

     public function update(PostRequest $request, Post $post)
    {
        $imagePath = $post->featured_image;

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title, $post),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $imagePath,
            'status' => $request->status,
            'published_at' => $request->status === 'published'
                ? ($request->published_at ?? $post->published_at ?? now())
                : null,
            'seo_title' => $request->seo_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }


      private function generateUniqueSlug(string $title, ?Post $post = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Post::withTrashed()
                ->where('slug', $slug)
                ->when($post, function ($query) use ($post) {
                    return $query->where('id', '!=', $post->id);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }


}
