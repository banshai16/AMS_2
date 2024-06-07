<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_view()
    {
        return view('home');
    }

    public function show_user()
    {
        $user = Users::count();
        return view('home', ['usercount' => $user]);
    }
}
