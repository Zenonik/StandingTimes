<?php

namespace App\Http\Livewire;

use App\Models\Standing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $list = [];
    public $filter_time = 1;
    public $start_date = null;
    public $end_date = null;
    public $standing = false;


    public function render()
    {
        $this->standing = auth()->user()->isStanding();

        $this->list = [];
        $this->getTops();
        $this->tops = [];
        if (!empty($this->list->all())) {
            if (!in_array(Auth::user()->id, array_keys($this->list->all()))) {
                $this->thisUser = [
                    'user' => Auth::user(),
                    'time' => gmdate('H:i:s', 0),
                    'level' => 0,
                ];
                $this->tops = $this->list->values()->take(10)->all();
            }
            else {
                $this->thisUser = $this->list[Auth::user()->id] ?? null;
                $this->tops = $this->list->values()->take(10)->all();
            }
        } else {
            $this->thisUser = ['user' => Auth::user(), 'time' => gmdate('H:i:s', 0), 'level' => Standing::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get()->sum('standing_time')];
            array_push($this->tops, $this->thisUser);
        }
        return view('livewire.home');
    }

    public function getTops()
    {
        $carbon = new Carbon();
        if ($this->filter_time == 2){
            $this->start_date = $carbon->startOfWeek();
            $this->end_date = $carbon->endOfWeek();
        }
        elseif ($this->filter_time == 3){
            $this->start_date = $carbon->startOfMonth();
            $this->end_date = $carbon->endOfMonth();
        }

        if ($this->filter_time == 1){
            $stand = Standing::whereDate('created_at', today())->orderBy('id', 'desc')->get()->groupBy('user_id');
        }
        elseif ($this->filter_time == 4){
            $stand = Standing::orderBy('id', 'desc')->get()->groupBy('user_id');
        }
        else{
            $stand = Standing::whereBetween('created_at', array($this->start_date, $this->end_date))->orderBy('id', 'desc')->get()->groupBy('user_id');
        }
        $stand->each(function ($standing) {
            $last_standing = $standing->where('standing', 1)->first();
            if ($standing->first()->standing == 1) {
                $time = $standing->where('standing', 0)->sum('standing_time') + Carbon::now()->diffInSeconds($last_standing->created_at);
                $alltime = Standing::where('user_id', $standing->first()->user_id)->where('standing', 0)->sum('standing_time') + Carbon::now()->diffInSeconds($last_standing->created_at);
            }
            else{
                $time = $standing->where('standing', 0)->sum('standing_time');
                $alltime = Standing::where('user_id', $standing->first()->user_id)->where('standing', 0)->sum('standing_time');
            }
            $this->list[$standing->first()->user_id] = [
                'user' => User::where('id', $standing->first()->user_id)->get()->first(),
                'time' => date("H:i:s", $time),
                'level' => floor(($alltime%2592000)/86400),
            ];
        });
        if ($this->filter_time == 1){
            $this->list = collect($this->list)->sortByDesc('time');
        }
        else{
            $this->list = collect($this->list)->sortByDesc('time')->sortByDesc('level');
        }
    }

    public function btnColor(): string
    {
        if (auth()->user()->deactivated) {
            return 'secondary';
        }
        return $this->standing ? 'danger' : 'success';
    }

    public function changeState()
    {
        if ((auth()->user())->deactivated) {
            return;
        }

        Standing::changeStandingFor(\auth()->id(), !$this->standing);
    }
}
