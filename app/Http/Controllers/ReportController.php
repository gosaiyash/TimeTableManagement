<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\singup_model;
use PDF;

class ReportController extends Controller
{
    public function showGenerateForm()
    {
        return view('admin.generate_report');
    }

    public function searchStudents(Request $request)
    {
        $request->validate([
            'enrollment_start' => 'required',
            'enrollment_end' => 'required'
        ]);

        $students = singup_model::whereBetween('enrollment_no', 
            [$request->enrollment_start, $request->enrollment_end])
            ->get();

        if ($students->isEmpty()) {
            return back()->with('error', 'No students found in the specified range.');
        }

        return view('admin.generate_report', compact('students'));
    }

    public function generatePDF($id)
    {
        $student = singup_model::findOrFail($id);
        
        $pdf = PDF::loadView('admin.student_report_pdf', compact('student'));
        
        return $pdf->download('student_report_'.$student->enrollment_no.'.pdf');
    }

    public function generateCombinedPDF(Request $request)
    {
        $request->validate([
            'enrollment_start' => 'required',
            'enrollment_end' => 'required'
        ]);

        $students = singup_model::whereBetween('enrollment_no', 
            [$request->enrollment_start, $request->enrollment_end])
            ->get();

        if ($students->isEmpty()) {
            return back()->with('error', 'No students found in the specified range.');
        }

        $pdf = PDF::loadView('admin.combined_student_report_pdf', compact('students'));
        
        return $pdf->download('combined_student_reports.pdf');
    }
} 