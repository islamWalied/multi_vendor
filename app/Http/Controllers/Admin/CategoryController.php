<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        $categories = Category::all(); // return collection object {{ show all categories }}
//        $categories = Category::simplePaginate(2); // show 2 of categories and show also next and previous only

        // This is how to make a filter in controller ,but we can do it by another way to be more clean

//        $query = Category::query();
//        if ($name = $request->query('name'))
//        {
//            $query->where('name', 'LIKE',"%{$name}%");
//        }
//        if ($status = $request->query('status'))
//        {
//            $query->whereStatus($status);
//        }



        /* this is how to use local scope in ORM  */

        /* $categories = Category::active()->paginate(2); */

//         $categories = Category::filter($request->query())->paginate(2);

         $categories = Category::with('parent')/*leftJoin('categories as p', "p.id" ,'=',"categories.parent_id")
             ->select([
                 "categories.*",
                 "p.name as parent_name"
             ])*/
             ->select('categories.*')

             // I want to get the count of products for each category
             ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count')

             // you can use another way to get the count
             ->withCount(
              ['products as products_count' => function ($query)
               {
                   $query->where('status', '=', 'active');
               } ])
             ->filter($request->query())
             ->orderBy('categories.id')
             ->paginate(5);


        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
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

        return Redirect::route('categories.index')->with('success','Category Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',compact('category'));
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
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $image = $category->image;
        if ($request->hasFile('image'))
        {
            if ($category->image)
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

        return Redirect::route('categories.index')->with('info','Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('categories.index')->with('danger','Category Trashed!');

    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view("dashboard.categories.trash",compact("categories"));
    }
    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return Redirect::route('categories.trash')->with('info','Category Restored!');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if ($category->image)
        {
            Storage::delete($category->image);
        }
        $category->forceDelete();
        return Redirect::route('categories.index')->with('danger','Category Deleted!');

    }
}
