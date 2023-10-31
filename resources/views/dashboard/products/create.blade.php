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

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
