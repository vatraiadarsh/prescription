<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;
// patient form request validation
use App\Http\Requests\PatientRequest;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // After refactoring the code we can search the patient by just entering the half name
        $search = request()->query('s');

        if ($search) {
            $patients = Patient::where('name', 'LIKE', "%{$search}%")
            ->paginate(10);
        }else{
           $patients = Patient::paginate(10);
        }

        return view('admin.patient.index', [
            'patients' => $patients,
            'total_patients' => Patient::count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Patient form request validation
    public function store(PatientRequest $request)
    {
        // save to database
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->description = $request->input('description');


        $patient->save();

        return redirect('/admin/patient')->with(
            'success',
            'Patient created successfully'
        );
    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin.patient.edit', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->name = $request->input('name');
        $patient->description = $request->input('description');
       if($request->has('status')){
           $patient->status = $request->input('status');

         }else{
              $patient->status = 'off';
         }

        $patient->update();

        return redirect('/admin/patient')->with(
            'success',
            'Patient updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return redirect('/admin/patient')->with(
            'success',
            'Patient deleted successfully'
        );
    }
}
