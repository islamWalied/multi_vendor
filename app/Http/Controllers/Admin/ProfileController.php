<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit',[
            'user' => $user,
            'countries' => Countries::getNames(),
            'locale' => Languages::getNames(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $user = Auth::user();
        $request->validate([
           'first_name' => ['required','string','max:255'],
           'last_name' => ['required','string','max:255'],
           'birthday' => ['nullable','date','before:today'],
           'gender' => ['required','in:male,female'],
           'country' => ['required','string','size:2'],
           'locale' => ['required','string','size:3'],
           'image' => ['nullable','image'],
        ]);
        $image = $user->profile->image;
        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->store('profiles','public');
        }
        $user->profile->fill([
            'user_id' => Auth::user()->id,
            'first_name' =>$request->first_name ?? $user->first_name,
            'last_name' =>$request->last_name ?? $user->last_name,
            'birthday' =>$request->birthday ?? $user->birthday,
            'gender' =>$request->gender ?? $user->gender,
            'street_address' =>$request->street_address ?? $user->street_address,
            'locale' =>$request->input('locale') ?? $user->locale,
            'city' =>$request->city ?? $user->city,
            'state' =>$request->state ?? $user->state,
            'postal_code' =>$request->postal_code ?? $user->postal_code,
            'country' =>$request->country ?? $user->country,
            'image' =>$image,

        ])->save();
//        $user->profile->fill($request->all())->save();

        //instead of all of this i can use the above code
/*        $profile = $user->profile;
        if ($profile->user_id)
        {
            $profile->update($request->all());
        }
        else {
//            $request->merge([
//               'user_id' => $user->id,
//            ]);
//            Profile::create([$request->all]);

            //I can use this instead of the above code
            $user->profile()->create($request->all());
        }*/

        return Redirect::route('dashboard.profile.edit')->with('success','Profile Updated!');
    }
}
