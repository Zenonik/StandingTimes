<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use App\Models\User;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function newEntry(Request $request)
    {
        if (empty(User::where('api_token', $request->key)->get()->all())){
            return response('Key not found!');
        }
        $user_id = User::where('api_token', $request->key)->get()->first()->id;

        $standing = new Standing();
        $standing->user_id = $user_id;
        $standing->standing = $request->value;
        $standing->created_at = now();
        $standing->updated_at = now();
        $standing->save();

        return response('User ' . $user_id . ' is now ' . ($request->value ? 'standing!' : 'sitting!'));
    }
}
