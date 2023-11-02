@extends('layouts.dashboard')

@section('title','Create Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">
        <a href="{{route('products.index')}}">Products</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection


@section('content')
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form')
        <x-form.button  type="Save"/>
    </form>

@endsection
