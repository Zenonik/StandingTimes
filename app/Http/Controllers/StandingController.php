<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StandingController extends Controller
{
    public function newEntry(Request $request)
    {
        if (empty(User::where('api_token', $request->key)->get()->all())) {
            return response('Key not found!');
        }
        if ($request->has('user') && (Auth::user()->admin === 1)) {
            $user_id = $request->get('user');
        } else {
            $user_id = User::where('api_token', $request->key)->get()->first()->id;
        }

        if ($request->value == 'true') {
            $value = 1;
        } elseif
        ($request->value == 'false') {
            $value = 0;
        } else {
            return response('Value not found!');
        }

        $bool = Standing::changeStandingFor($user_id, $value);
        if (! $bool) {
            return response('Value already set!');
        }

        return response('User ' . $user_id . ' is now ' . ($value ? 'standing!' : 'sitting!'));
    }
}
