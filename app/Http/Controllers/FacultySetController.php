<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\set_sub_fac_stu_model;
use App\Models\add_faculty_model;
use App\Models\subject_model;
use Illuminate\Support\Facades\DB;

class FacultySetController extends Controller
{
    public function index()
    {
        $facultySets = DB::table('set_sub_fac_stu')
            ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
            ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
            ->select(
                'set_sub_fac_stu.*',
                'add_faculty_models.faculty_name as faculty_name',
                'subject_models.subject_name as subject_name'
            )
            ->where('set_sub_fac_stu.deleted', '=', 0)
            ->get();

        return view('admin.view_faculty_sets', compact('facultySets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'min_lec' => 'required|numeric',
            'max_lec' => 'required|numeric',
            'daily_lec' => 'required|numeric',
            'total_lec' => 'required|numeric',
            'roomno' => 'required',
            'class_type' => 'required|in:Theory,Lab'
        ]);

        $set = set_sub_fac_stu_model::findOrFail($id);
        
        $set->update([
            'min_lec' => $request->min_lec,
            'max_lec' => $request->max_lec,
            'daily_lec' => $request->daily_lec,
            'total_lec' => $request->total_lec,
            'roomno' => $request->roomno,
            'class_type' => $request->class_type
        ]);

        return redirect()->back()->with('success', 'Faculty set updated successfully');
    }

    public function destroy($id)
    {
        $set = set_sub_fac_stu_model::findOrFail($id);
        $set->update(['deleted' => 1]);

        return redirect()->back()->with('success', 'Faculty set deleted successfully');
    }
} 