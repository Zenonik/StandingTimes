<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function newEntry(Request $request)
    {
        if (empty(User::where('api_token', $request->key)->get()->all())) {
            return response('Key not found!');
        }
        $user_id = User::where('api_token', $request->key)->get()->first()->id;

        if ($request->value == 'true') {
            $value = 1;
        } elseif ($request->value == 'false') {
            $value = 0;
        } else {
            return response('Value not found!');
        }

        $current = Standing::where('user_id', $user_id)->orderBy('id', 'desc')->get()->first();
        if (isset($current)) {
            if ($current->standing == $value) {
                return response('Value already set!');
            }
            if ($value == 0) {
                $standing_time = $current->created_at->diffInSeconds(now());
            }
            else {
                $standing_time = 0;
            }
        }
        elseif (!isset($current) && $value == 0) {
            $standing_time = 0;
        }

        $standing = new Standing();
        $standing->user_id = $user_id;
        $standing->standing = $value;
        $standing->created_at = now();
        $standing->updated_at = now();
        $standing->standing_time = $standing_time;
        $standing->save();

        return response('User ' . $user_id . ' is now ' . ($value ? 'standing!' : 'sitting!'));
    }
}
