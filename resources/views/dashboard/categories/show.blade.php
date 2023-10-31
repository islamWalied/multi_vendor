@extends('layouts.dashboard')

@section('title',$category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('categories.index')}}">Categories</a>
    </li>
    <li class="breadcrumb-item active">{{$category->name}}</li>
@endsection


@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Store</th>
            <th scope="col">Status</th>
            <th scope="col">Image</th>
            <th >Created At</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
        @php
            $products = $category->products()->with('store')->paginate();
        @endphp
        @forelse($category->products as $product)
            <tr>
                <td>{{$product->name}}</td>
                {{--
                    what is the problem of this !!??!!!!???!?!?!?
                    the problem is when call it make its sql sentence to get it
                    but this is a load for your project so check the controller i will continue there
                 --}}
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>
                <td>
                    @if($product->image)
                        @if($product->image[0][0] == 'h')
                            <a href="{{asset(/*'storage/' . */$product->image)}}">
                                <img src="{{asset(/*'storage/' . */$product->image)}}" height="60px" />
                            </a>
                        @else
                            <a href="{{asset('storage/' . $product->image)}}">
                                <img src="{{asset('storage/' . $product->image)}}" height="60px" />
                            </a>
                        @endif
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{$product->created_at}}</td>
                <td>
                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-outline-success ">Edit</a>
                    <form action="{{route('products.destroy',$product->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @empty
            <tr> <td colspan="5">No Products Found</td> </tr>
        @endforelse
        </tbody>
    </table>
    {{$products->links()}}

@endsection
