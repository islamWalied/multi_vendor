@extends('layouts.dashboard')

@section('title','Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection


@section('content')
    <x-alert type="success"/>
    <x-alert type="info"/>
    <x-alert type="danger"/>
    <div class="mb-3 text-right">
{{--        <a href="{{route('products.trash')}}" class="btn btn-outline-light">--}}
{{--            Trash--}}
{{--        </a>--}}
        <a href="{{route('products.create')}}" class="btn btn-outline-primary">
            New product
        </a>
    </div>
<form action="{{\Illuminate\Support\Facades\URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
{{--    <div class="input-group">--}}
        <input type="search" class="form-control mx-2" name="name" placeholder="Name" value="{{request('name')}}">
        <select name="status" class="form-control">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
{{--    </div>--}}
    <button class="btn btn-dark mx-2">Filter</button>
</form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Store</th>
            <th scope="col">Status</th>
            <th scope="col">Image</th>
            <th >Created At</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->name}}</td>
                {{--
                    what is the problem of this !!??!!!!???!?!?!?
                    the problem is when call it make its sql sentence to get it
                    but this is a load for your project so check the controller i will continue there
                 --}}
                <td>{{$product->category->name ?? ""}}</td>
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>
                <td>
                    @if($product->image)
                        @if($product->image[0][0] == 'h')
                            <a href="{{asset(/*'storage/' . */$product->image)}}">
                                <img src="{{asset(/*'storage/' . */$product->image)}}" style="height: 60px" />
                            </a>
                        @else
                            <a href="{{asset('storage/' . $product->image)}}">
                                <img src="{{asset('storage/' . $product->image)}}" style="height: 60px" />
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
                <tr> <td colspan="7">No Products Found</td> </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->withQueryString()->links() }}
@endsection
