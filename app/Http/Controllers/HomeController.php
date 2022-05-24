<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Prescription;
use App\Models\Patient;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $user = User::find(auth()->user()->id);
        // get 7 prescriptions
        $p = Prescription::all();
        // get only the last 7 prescriptions
        $prescriptions = $p->take(7);
        $patients = Patient::all();
        return view('home', compact('user', 'prescriptions', 'patients'));

    }
}

