<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
/*
        //Here i wanted to get the products for the authenticated user and if auth user do not have stores it show all products
        $user = Auth::user();
        if ($user->store_id)
        {
            $products = Product::where('store_id','=',$user->store_id)->paginate();
        }
        else
        {
        $products = Product::paginate();
        }*/
        // so here i write only this as i made a global scope to run for this model
        /*      $products = Product::paginate();

*/


        // to be continued for what i talk in index file here laravel made something to your performance
        // its called eager loading
        // when you have a relationship and you want to use just pass the relationship method to with() to be good
        // and to rest in peace just do it
        // so i will make the eager load and show you

        $products = Product::with(['category','store'])->filter($request->query())->paginate();

        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Product();
        $tags = new Tag();
        return view('dashboard.products.create',compact('products','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = Product::create($request->except('tags'));
        $tags = json_decode($request->tags);
        $saved_tags = Tag::all();
        $tag_ids = [];

        foreach ($tags as $item)
        {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug',$slug)->first();
            if (!$tag)
            {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $products->tags()->sync($tag_ids);

        return Redirect::route('products.index')->with('success','Product Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findOrFail($id);
        $tags = implode(',', $products->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit',compact('products','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = Product::findOrFail($id);
        $products->update($request->except('tags'));
        $tags = json_decode($request->tags);
        $saved_tags = Tag::all();
        $tag_ids = [];

        foreach ($tags as $item)
        {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug',$slug)->first();
            if (!$tag)
            {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $products->tags()->sync($tag_ids);

        return Redirect::route('products.index')->with('success','Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
