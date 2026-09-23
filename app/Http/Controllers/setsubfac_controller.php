<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject_model;
use App\Models\set_sub_fac_stu_model;
use App\Models\add_faculty_model;
use App\Models\temptimetablemodel;
use DB;




class setsubfac_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required',
            'subject_id' => 'required',
            'min_lec' => 'required|numeric',
            'max_lec' => 'required|numeric',
            'daily_lec' => 'required|digits_between:0,1',
            'total_lec' => 'required|numeric',
            'roomno' => 'required',
            'class_type' => 'required',
        ]);

        $rec = new set_sub_fac_stu_model();
        $rec->faculty_id = $request->faculty_id;
        $rec->subject_id = $request->subject_id;
        $rec->min_lec = $request->min_lec;
        $rec->max_lec = $request->max_lec;
        $rec->daily_lec = $request->daily_lec;
        $rec->total_lec = $request->total_lec;
        $rec->remain_A = $request->total_lec;
        $rec->remain_B = $request->total_lec;
        $rec->remain_C = $request->total_lec;
        $rec->remain_D = $request->total_lec;
        $rec->roomno = $request->roomno;
        $rec->class_type = $request->class_type;
        $rec->save();

        return redirect('/setdata')->with('success','Record successfully Stored!');
    }

    public function getdata()
    {
        $rec = subject_model::where('deleted',0)
                            ->get();

        $rec1 = add_faculty_model::where('deleted',0)
                                 ->get();

        return view('admin/set_sub_fac', compact('rec','rec1'));
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
