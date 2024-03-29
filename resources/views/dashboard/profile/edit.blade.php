@extends('layouts.dashboard')

@section('title','Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active mb-6">
        Edit Profile
    </li>
@endsection


@section('content')
    <x-alert type="success" />
    <form action="{{route('dashboard.profile.update',$user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row mb-3">
            <div class="col-md-6">
                <input type="text"
                       name="first_name"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                            rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                            w-full p-2.5 dark:placeholder-gray-400 @error('first_name') is-invalid @enderror"
                       value="{{$user->profile->first_name}}"
                       placeholder="First Name">
                @error('first_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="col-md-6">
                <input type="text"
                       name="last_name"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                            rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                            w-full p-2.5 dark:placeholder-gray-400 @error('last_name') is-invalid @enderror"
                       value="{{$user->profile->last_name}}"
                       placeholder="Last Name" >
                @error('last_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-6">
                <input type="date"
                       name="birthday"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                                w-full p-2.5 dark:placeholder-gray-400 @error('birthday') is-invalid @enderror"
                       value="{{$user->profile->birthday}}"
                       placeholder="Birthday" >
                @error('birthday')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-md-6">
                <input class="w-full text-gray-900 border block p-1.5 border-gray-300 rounded-lg
                                cursor-pointer bg-gray-50 @error('image') is-invalid @enderror"
                       name="image"
                       type="file">
                @error('image')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-4">
                <input type="text"
                       name="street_address"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                                w-full p-2.5 dark:placeholder-gray-400 @error('street_address') is-invalid @enderror"
                       placeholder="Street Address"
                       value="{{$user->profile->street_address}}">
                @error('street_address')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-md-4">
                <input type="text"
                       name="city"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                                w-full p-2.5 dark:placeholder-gray-400 @error('city') is-invalid @enderror"
                       placeholder="City"
                       value="{{$user->profile->city}}">
                @error('city')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-md-4">
                <input type="text"
                       name="state"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                                w-full p-2.5 dark:placeholder-gray-400 @error('state') is-invalid @enderror"
                       placeholder="State"
                       value="{{$user->profile->state}}">
                @error('state')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-4">
                <input type="text"
                       name="postal_code"
                       class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                                w-full p-2.5 dark:placeholder-gray-400 @error('postal_code') is-invalid @enderror"
                       placeholder="Postal Code"
                       value="{{$user->profile->postal_code}}">
                @error('postal_code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-md-4">
                <select id="countries" name="country" class="border-gray-300 text-gray-900 rounded-lg block w-full p-2 @error('country') is-invalid @enderror">
                    <option selected>Choose A Country</option>
                    @foreach($countries as $country =>$text)
                        <option value="{{$country}}" @selected($user->profile->country == $country)>{{$text}}</option>
                    @endforeach
                </select>
{{--                @error('country')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror--}}
{{--                <x-form.select name="country" :options="$countries"/>--}}

            </div>
            <div class="col-md-4">
                <select id="countries" name="locale" class="border-gray-300 text-gray-900 rounded-lg block w-full p-2 @error('locale') is-invalid @enderror">
                    <option value="" selected>Choose A Language</option>
                    @foreach($locale as $local =>$text)
                        <option value="{{$local}}"  @selected($user->profile->locale == $local)>{{$text}}</option>
                    @endforeach
                </select>
                @error('locale')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
{{--                <x-form.select name="locale" :options="$locale"/>--}}
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-6">
                <div class="col-md-3">
                    <input id="default-radio-1"
                           type="radio"
                           value="male"
                           name="gender"
                           class="w-4 @error('gender') is-invalid @enderror"
                        @checked($user->profile->gender == 'male')>
                    <label for="default-radio-1" class=""> Male</label>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <input id="default-radio-2"
                           type="radio"
                           value="female"
                           name="gender"
                           class="w-4 @error('gender') is-invalid @enderror"
                        @checked($user->profile->gender == 'female')>
                    <label for="default-radio-2" class=""> Female</label>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
    </form>
@endsection
