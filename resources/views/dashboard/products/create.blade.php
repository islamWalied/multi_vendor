@extends('layouts.dashboard')

@section('title','Create Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('categories.index')}}">Categories</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection


@section('content')
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')

        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
    </form>

@endsection
