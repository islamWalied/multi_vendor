@extends('layouts.dashboard')

@section('title','Edit Categories')
@section('breadcrumb')
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
    <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Category Name" value="{{$category->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select name="parent_id" class="form-control" >
                <option value="" selected>Primary</option>
                @foreach($parents as $parent)
                    <option value="{{$parent->id}}" @selected($category->parent_id == $parent->id)> {{$parent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Description">{{$category->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Category Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <a href="{{asset('storage/' . $category->image)}}">
                <img src="{{asset('storage/' . $category->image)}}" height="80px" />
            </a>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" @checked($category->status == 'active')>
                <label class="form-check-label" for="flexRadioDefault1">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="archived"@checked($category->status == 'archived')>
                <label class="form-check-label" for="flexRadioDefault2">
                   Archived
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
