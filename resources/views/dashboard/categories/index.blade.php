@extends('layouts.dashboard')

@section('title','Categories')
@section('breadcrumb')
    <li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>

    @endif
    <div class="mb-3 text-right">
        <a href="{{route('categories.create')}}" class="btn btn-outline-primary">
            New Category
        </a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Parent</th>
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
                <td>
                    <a href="{{asset('storage/' . $category->image)}}">
                        <img src="{{asset('storage/' . $category->image)}}" height="60px" />
                    </a>
                </td>
                <td>{{$category->created_at}}</td>
                <td>
                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success ">Edit</a>
                    <form action="{{route('categories.destroy',$category->id)}}" method="post" style="display: inline-block">
                        {{--              <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                        @csrf
                        {{--                  Form Method Spoofing--}}
                        {{--                    <input type="hidden" name="_method" value="delete">--}}
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
@endsection
