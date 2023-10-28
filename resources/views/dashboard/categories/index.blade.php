@extends('layouts.dashboard')

@section('title','Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')
    <x-alert type="success"/>
    <x-alert type="info"/>
    <x-alert type="danger"/>
    <div class="mb-3 text-right">
        <a href="{{route('categories.create')}}" class="btn btn-outline-primary">
            New Category
        </a>
    </div>
<form action="{{\Illuminate\Support\Facades\URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
{{--    <div class="input-group">--}}
        <input type="search" class="form-control mx-2" name="name" placeholder="Name" value="{{request('name')}}">
        <select name="status" class="form-control">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
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
            <th scope="col">Parent</th>
            <th scope="col">Status</th>
            <th scope="col">Image</th>
            <th >Created At</th>
            <th scope="col">Controls</th>
        </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->parent_id}}</td>
                <td>{{$category->status}}</td>
                <td>
                    @if($category->image)
                    <a href="{{asset('storage/' . $category->image)}}">
                        <img src="{{asset('storage/' . $category->image)}}" height="60px" />
                    </a>
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{$category->created_at}}</td>
                <td>
                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success ">Edit</a>
                    <form action="{{route('categories.destroy',$category->id)}}" method="post" style="display: inline-block">
                                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @csrf
{{--                                          Form Method Spoofing--}}
                                            <input type="hidden" name="_method" value="delete">
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>

            @empty
                <tr> <td colspan="7">No Categories Found</td> </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->withQueryString()->links()}}
@endsection
