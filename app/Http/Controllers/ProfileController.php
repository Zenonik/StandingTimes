<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile')->with(compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $user = auth()->user();
        Storage::delete('public/' . $user->avatar);
        if (($path = $request->file('avatar')) !== null) {
            $user->avatar = $path->store('avatars', 'public');
        }
        $user->name = $request->get('name');
        if ($request->get('password') !== null) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
