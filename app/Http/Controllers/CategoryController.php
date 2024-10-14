<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(10);

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
        DB::transaction(function() use($request) {
            $validated = $request->validated();
        
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->store('icons', 'public');
    
                $validated['icon'] = Storage::url($path);
            }
    
            $validated['slug'] = Str::slug($validated['name']);
    
            $newCategory = Category::create($validated);
        });
        
        return redirect()->route('admin.categories.index')->with('success', 'Berhasil tambah data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
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
    public function update(CategoryRequest $request, Category $category)
    {
        DB::transaction(function() use($request,$category) {
            $validated = $request->validated();
        
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->store('icons', 'public');
    
                $validated['icon'] = Storage::url($path);
            }
    
            $validated['slug'] = Str::slug($validated['name']);
    
            $category->update($validated);
        });
        
        return redirect()->route('admin.categories.index')->with('success', 'Berhasil ubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {   
        DB::transaction(function() use ($category) {
             $category->delete();
        });

        return redirect()->route('admin.categories.index');
    }
}
