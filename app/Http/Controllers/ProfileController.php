<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * The index function returns the profile view with the user variable
     *
     * @return The user's profile page.
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile')->with(compact('user'));
    }

    /**
     * > It deletes the old avatar, uploads the new one, updates the name and password, and redirects the user to the
     * profile page with a success message
     *
     * @param Request request The request object.
     *
     * @return The user's profile page with a success message.
     */
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
