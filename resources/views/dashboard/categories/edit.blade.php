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

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
