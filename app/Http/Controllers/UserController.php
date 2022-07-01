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
}
