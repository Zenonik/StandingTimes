<?php

namespace App\Http\Livewire;

use App\Models\Standing;
use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users = null;

    public function render()
    {
        $this->users = User::all();
        foreach ($this->users as $user) {
            if (Standing::where('user_id', $user->id)->orderBy('id', 'desc')->get()->first()->standing == 1) {
                $user->standing = true;
            } else {
                $user->standing = false;
            }
        }
        return view('livewire.users');
    }
}
