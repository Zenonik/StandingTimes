<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->admin) {
            return redirect('/');
        }
        return view('users');
    }

    public function changeActive(Request $request)
    {
        if (!Auth::user()->admin) {
            return redirect('/');
        }

        $user = User::find($request->user);
        $user->deactivated = $request->value;
        $user->save();
        return response('User ' . $user->id . ' is now ' . ($user->active ? 'active!' : 'inactive!'));
    }
}
