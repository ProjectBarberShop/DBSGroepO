<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $userData = auth()->user();
        return view('cms.profile.index')->with('userdata' , $userData);
    }
}
