<?php

namespace App\Http\Livewire;

use App\Models\Standing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $list = [];

    public function render()
    {
        $this->getTops();
        $this->tops = [];
        if (!empty($this->list->all())) {
            $this->thisUser = $this->list[Auth::id()] ?? null;
            $this->tops = $this->list->values()->take(10)->all();
        } else {
            $this->thisUser = ['user' => Auth::user(), 'time' => gmdate('H:i:s', 0)];
            array_push($this->tops, $this->thisUser);
        }

        return view('livewire.home');
    }

    public function getTops()
    {
        Standing::whereDate('created_at', today())->orderBy('id', 'desc')->get()->groupBy('user_id')->each(function ($standing) {
            $last_standing = $standing->where('standing', 1)->first();
            if ($standing->first()->standing == 1) {
                $time = date("H:i:s",$standing->where('standing', 0)->sum('standing_time') + Carbon::now()->diffInSeconds($last_standing->created_at));
            }
            else{
                $time = date("H:i:s",$standing->where('standing', 0)->sum('standing_time')); // 1 Minute = 100 Seconds !!??
            }
            $this->list[$standing->first()->user_id] = [
                'user' => User::where('id', $standing->first()->user_id)->get()->first(),
                'time' => $time,
            ];
        });
        $this->list = collect($this->list)->sortByDesc('time');
    }
}
