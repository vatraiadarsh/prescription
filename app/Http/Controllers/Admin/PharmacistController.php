<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacist;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;


class PharmacistController extends Controller
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
            $pharmacists = Pharmacist::where('medicine_name', 'LIKE', "%{$search}%")
            ->orWhere('per_day', 'LIKE', "%{$search}%")
            ->orWhere('duration', 'LIKE', "%{$search}%")
            ->orWhere('total_quantity', 'LIKE', "%{$search}%")
            ->orWhere('remarks', 'LIKE', "%{$search}%")
            ->paginate(10);
        }else{
           $pharmacists = Pharmacist::paginate(10);
        }

        return view('admin.pharmacist.index', [
            'pharmacists' => $pharmacists,
            'total_patients' => Pharmacist::count(),
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




        // save to database
        $pharmacist = new Pharmacist();
        $pharmacist->medicine_name = $request->input('medicine_name');
        $pharmacist->per_day = $request->input('per_day');
        $pharmacist->duration = $request->input('duration');
        $pharmacist->total_quantity = $request->input('total_quantity');
        $pharmacist->remarks = $request->input('remarks');


        $pharmacist->save();

        return redirect('/admin/pharmacist')->with(
            'success',
            'Pharmacist created successfully'
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
        $pharmacist = Pharmacist::findOrFail($id);
        return view('admin.pharmacist.edit', compact('pharmacist'));
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
        $pharmacist = Pharmacist::findOrFail($id);
        $pharmacist->medicine_name = $request->input('medicine_name');
        $pharmacist->per_day = $request->input('per_day');
        $pharmacist->duration = $request->input('duration');
        $pharmacist->total_quantity = $request->input('total_quantity');
        $pharmacist->remarks = $request->input('remarks');


        $pharmacist->update();

        return redirect('/admin/pharmacist')->with(
            'success',
            'Pharmacist updated successfully'
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
        $pharmacist = Pharmacist::find($id);
        $pharmacist->delete();
        return redirect('/admin/pharmacist')->with(
            'success',
            'Pharmacist deleted successfully'
        );
    }
}
