<?php

namespace App\Http\Controllers;
use App\Models\subject_model;
use App\Models\add_faculty_model;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;


class pdf_download extends Controller
{
    public function subjectV()
    {
        $rec = subject_model::get();

        $pdf = PDF::loadview('admin/download_subject',compact('rec'));

        return $pdf->stream('Subject.pdf');
        
    }

    public function course()
    {
        $rec = DB::table('set_sub_fac_stu')
         ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
         ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
         ->select('*')
         ->get();
         

        $pdf = PDF::loadview('admin/download_couse',compact('rec'));

        return $pdf->stream('Course.pdf');
        
    }
    public function subjectD()
    {
       $rec = subject_model::get();

       $pdf = PDF::loadview('admin/download_subject',compact('rec'));

       return $pdf->download('Subject.pdf');
        
    }

    public function faculty()
    {

    }
}
