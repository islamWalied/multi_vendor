<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        $products = Product::with(['category','store'])->paginate();

        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
