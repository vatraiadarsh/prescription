<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard', [
            'total_patients' => Patient::count(),
            'total_active_patients' => Patient::where('status', 'on')->count(),
            'total_inactive_patients' => Patient::where('status', 'off')->count(),
            'total_prescriptions' => Prescription::count(),
            'total_active_prescriptions' => Prescription::where('status', 'on')->count(),
            'total_inactive_prescriptions' => Prescription::where('status', 'off')->count(),
            'total_users' => User::count(),




        ]);
    }
}
