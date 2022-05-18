<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Patient;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;


class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // search and return view
        $search = request()->query('s');
        if ($search) {
            $prescriptions = Prescription::where('name', 'LIKE', "%{$search}%")
            ->orWhere('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->paginate(2);
        }else{
            $prescriptions = Prescription::paginate(3);
        }

        return view('admin.prescription.index', [
            'prescriptions' => $prescriptions,
            'total_products' => Prescription::count(),
            'patients' => Patient::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request validation
        $request->validate([
            'name' => 'required|unique:prescriptions',
            'title' => 'required',
            'description' => 'required',

        ]);



        // save to database
        $prescription = new Prescription();
        $prescription->name = $request->input('name');
        $prescription->title = $request->input('title');
        $prescription->description = $request->input('description');



        $prescription->save();


        // sync() accepts an array of IDs to place on the pivot table

        // convert an string to array
        // $p = explode(',', $request->input('patients'));

        // $prescription->patients()->sync($request->input('patients'));
        $prescription->patients()->sync($request->input('patients'));





        return redirect('/admin/prescription')->with(
            'success',
            'Prescription created successfully'
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        $patients = Patient::all();
        return view('admin.prescription.edit', compact('prescription', 'patients'));
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
        $prescription = Prescription::findOrFail($id);
        $prescription->name = $request->input('name');
        $prescription->title = $request->input('title');
        $prescription->description = $request->input('description');

        if($request->has('status')){
            $prescription->status = $request->input('status');

          }else{
               $prescription->status = 'off';
          }


        $prescription->update();


        $prescription->patients()->sync($request->input('patients'));

        return redirect('/admin/prescription')->with(
            'success',
            'Prescription updated successfully'
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
        $prescription = Prescription::findOrFail($id);

        $prescription->delete();
        return redirect('/admin/prescription')->with(
            'success',
            'Prescription deleted successfully'
        );
    }
}
