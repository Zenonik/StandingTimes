<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    public static function changeStandingFor($user_id, $value): bool
    {
        $current = Standing::where('user_id', $user_id)->orderBy('id', 'desc')->get()->first();
        if (isset($current)) {
            if ($current->standing == $value) {
                return false;
            }
            if ($value == 0) {
                $standing_time = $current->created_at->diffInSeconds(now());
            } else {
                $standing_time = 0;
            }
        } elseif (!isset($current) && $value == 0) {
            $standing_time = 0;
        }

        $standing = new static();
        $standing->user_id = $user_id;
        $standing->standing = $value;
        $standing->created_at = now();
        $standing->updated_at = now();
        $standing->standing_time = $standing_time;
        $standing->save();

        return true;
    }
}
