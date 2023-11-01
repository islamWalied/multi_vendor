@extends('layouts.dashboard')

@section('title','Edit Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('categories.index')}}">Categories</a>
    </li>
    <li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
    <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('dashboard.categories._form')

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
    </form>

@endsection
