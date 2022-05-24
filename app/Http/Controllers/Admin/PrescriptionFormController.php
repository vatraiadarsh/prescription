<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrescriptionForm;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;


class PrescriptionFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->query('s');

        if ($search) {
            $prescriptionforms = PrescriptionForm::where('type', 'LIKE', "%{$search}%")
            ->orWhere('medicine_name', 'LIKE', "%{$search}%")
            ->orWhere('per_day', 'LIKE', "%{$search}%")
            ->orWhere('duration', 'LIKE', "%{$search}%")
            ->orWhere('quantity', 'LIKE', "%{$search}%")
            ->paginate(10);
        }else{
           $prescriptionforms = PrescriptionForm::paginate(10);
        }


        return view('admin.prescriptionform.index', [
            'prescriptionforms' => $prescriptionforms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate all the incomming requests






        // save to database
        $prescriptionform = new PrescriptionForm();
        $prescriptionform->type = $request->input('type');
        $prescriptionform->medicine_name = $request->input('medicine_name');
        $prescriptionform->duration = $request->input('duration');
        $prescriptionform->per_day = $request->input('per_day');
        // quantity = duration* per_day
        $prescriptionform->quantity = $request->input('duration') * $request->input('per_day');
        // $prescriptionform->quantity = $request->input('quantity');



        $prescriptionform->save();

        return redirect('/admin/prescriptionform')->with(
            'success',
            'PrescriptionForm created successfully'
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
        $prescriptionform = PrescriptionForm::findOrFail($id);
        return view('admin.prescriptionform.edit', compact('prescriptionform'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prescriptionform = PrescriptionForm::findOrFail($id);
        $prescriptionform->type = $request->input('type');
        $prescriptionform->medicine_name = $request->input('medicine_name');
        $prescriptionform->duration = $request->input('duration');
        $prescriptionform->per_day = $request->input('per_day');
         // quantity = duration* per_day
        $prescriptionform->quantity = $request->input('duration') * $request->input('per_day');

        $prescriptionform->update();

        return redirect('/admin/prescriptionform')->with(
            'success',
            'PrescriptionForm updated successfully'
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
        $prescriptionform = PrescriptionForm::find($id);
        $prescriptionform->delete();
        return redirect('/admin/prescriptionform')->with(
            'success',
            'PrescriptionForm deleted successfully'
        );
    }
}
