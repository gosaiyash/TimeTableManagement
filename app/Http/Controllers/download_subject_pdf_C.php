<?php

namespace App\Http\Controllers;
use App\Models\subject_model;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class download_subject_pdf_C extends Controller
{
    public function index()
    {
        //return view('index');
          // download in Browser
        //return $pdf->download('krisha.pdf');

        // fetch all the records from db table
        $records = subject_model::get();
        $pdf = PDF::loadView('/download_subject', compact('records'));
        return $pdf->stream('subject.pdf');
        

    }
    public function download()
    {
        //return view('index');
        //$pdf = PDF::loadView('index');
        //return $pdf->stream('sumamah.pdf');   // download in Browser
        //return $pdf->download('krisha.pdf');

        // fetch all the records from db table
        $records = subject_model::get();
        $pdf = PDF::loadView('/download_subject', compact('records'));
        return $pdf->download('subject.pdf');
        

    }
}
