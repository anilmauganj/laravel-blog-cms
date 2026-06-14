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

        $recentPosts = Post::where('status', 'published')
                     ->latest()
                     ->take(5)
                     ->get();

           $categories = Category::where('status', true)
                        ->orderBy('name')
                         ->get();

         return view('frontend.blog.index',  compact('posts', 'recentPosts', 'categories'));
    }


     public function show(string $slug)
    {
        $post = Post::with('category')
                 ->where('slug', $slug)
                 ->where('status', 'published')
                 ->firstOrFail();

        $post->increment('views');

         $recentPosts = Post::where('status', 'published')
                        ->latest()
                        ->take(5)
                        ->get();

         $categories = Category::where('status', true)
                        ->orderBy('name')
                        ->get();


        return view(
        'frontend.blog.show',
        compact('post', 'recentPosts', 'categories')
        );
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

        $recentPosts = Post::where('status', 'published')
                            ->latest()
                            ->take(5)
                            ->get();
        
         $categories = Category::where('status', true)
                                ->orderBy('name')
                                ->get();

        return view('frontend.blog.index', compact('posts', 'category','recentPosts',
            'categories'));
    }
}
