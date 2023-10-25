@extends('layouts.dashboard')

@section('title','Create Categories')
@section('breadcrumb')
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Create</li>
@endsection


@section('content')
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select name="parent_id" class="form-control" >
                <option value="" selected>Primary</option>
                @foreach($parents as $parent)
                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Category Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="archived">
                <label class="form-check-label" for="flexRadioDefault2">
                   Archived
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
