<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Prescription;


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
        // id paramater of the url can be accessed via $id
        // i.e like req.params.id
        // dd($id);

        // if (auth()->user()->id == $id) {
        //     $user = User::find($id);
        //     $profile = Profile::find($id);
        //     return view('home', compact('user', 'profile'));
        //     } else {
        //     return redirect()->back();
        // }


        $user = User::find(auth()->user()->id);
        $profile = Profile::find(auth()->user()->id);
        $prescriptions = Prescription::where('user_id', auth()->user()->id)->get();
        return view('home', compact('user', 'profile'));

    }
}
