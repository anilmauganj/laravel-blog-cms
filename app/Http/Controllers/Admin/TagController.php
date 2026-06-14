<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(10);

        return view('admin.tags.index', compact('tags'));
    }

     public function create()
    {
        return view('admin.tags.create');
    }

     public function store(TagRequest $request)
    {
        Tag::create([
            'name' => $request->name,
            'slug' => $this->generateUniqueSlug($request->name),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag created successfully.');
    }

     public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }


     public function update(TagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'slug' => $this->generateUniqueSlug($request->name, $tag),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

     public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }

    private function generateUniqueSlug(string $name, ?Tag $tag = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Tag::withTrashed()
                ->where('slug', $slug)
                ->when($tag, function ($query) use ($tag) {
                    return $query->where('id', '!=', $tag->id);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }


}
