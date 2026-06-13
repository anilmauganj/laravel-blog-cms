<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $slug = $this->generateUniqueSlug($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $slug = $this->generateUniqueSlug($request->name, $category->id);

         $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status,
        ]);

         return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

         return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }



            private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
        {
            $slug = Str::slug($name);
            $originalSlug = $slug;
            $count = 1;

            while (
                Category::withTrashed()->where('slug', $slug)
                    ->when($ignoreId, function ($query) use ($ignoreId) {
                        $query->where('id', '!=', $ignoreId);
                    })
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            return $slug;
        }
}
