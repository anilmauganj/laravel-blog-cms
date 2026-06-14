<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('frontend.blog.index', compact('posts'));
    }


     public function show(string $slug)
    {
        $post = Post::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $post->increment('views');

        return view('frontend.blog.show', compact('post'));
    }


     public function category(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $posts = $category->posts()
            ->with('category')
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('frontend.blog.index', compact('posts', 'category'));
    }
}
