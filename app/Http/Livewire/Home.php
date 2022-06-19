<?php

namespace App\Http\Livewire;

use App\Models\Standing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $active = "Sitzt!";

    public function render()
    {
        $this->time = "03:00:00"; //implement this shit
        $this->tops = [1=>"1st", 2=>"2nd", 3=>"3rd", 4=>"4th", 5=>"5th", 6=>"6th", 7=>"7th", 8=>"8th", 9=>"9th", 10=>"10th"]; //implement later
        return view('livewire.home');
    }
}
