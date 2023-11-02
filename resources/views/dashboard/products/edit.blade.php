@extends('layouts.dashboard')

@section('title','Edit Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('products.index')}}">Products</a>
    </li>
    <li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
    <form action="{{route('products.update',$products->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('dashboard.products._form')
        <x-form.button type="Update" />
    </form>

@endsection
