<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return redirect('login');
    }

    public function welcome()
    {
        return view('welcome');
    }
}
