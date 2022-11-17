<?php

namespace App\Http\Controllers\{guard};

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('{guard}.auth:{guard}');
    }

    /**
     * Show the {guard} dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('guard.home');
    }
}
