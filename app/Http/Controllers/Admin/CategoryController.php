<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //return collection object
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = null;
        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->store('categories','public');
        }
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'image' => $image,
            'slug' => Str::slug($request->post('name')),
        ]);

        return Redirect::route('categories.index')->with('success','the category is created successfully');
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
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id','<>',$id)
            ->get();
        return view('dashboard.categories.edit',compact('parents','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $image = $category->image;
        if ($request->hasFile('image'))
        {
            Storage::delete($category->image);
            $image = $request->file('image')->store('categories','public');
        }
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'image' => $image,
            'slug' => Str::slug($request->post('name')),
        ]);

        return Redirect::route('categories.index')->with('success','the category is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        Storage::delete($category->image);
        $category->delete();
        return Redirect::route('categories.index')->with('success','the category is deleted successfully');

    }
}
