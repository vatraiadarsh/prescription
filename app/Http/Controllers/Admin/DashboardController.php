<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard', [
            'total_patients' => Patient::count(),


        ]);
    }
}
