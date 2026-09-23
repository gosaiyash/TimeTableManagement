<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\admin_model;
use App\Models\add_faculty_model;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\SendAttachmentMail;
use App\Models\user_email_model;
use App\Models\upload_time_table;



use DB;

class admin_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function generatecourse(Request $request )
    {
        $rec = DB::table('set_sub_fac_stu')
         ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
         ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
         ->select('*')
         ->where('subject_models.subject_name', 'LIKE',  $request->subject_name)
         ->where('add_faculty_models.faculty_name', 'LIKE', $request->faculty_name) 
        //  ->where('set_sub_fac_stu.total_lec', '=',$request->total_lec)
         ->get();
         
        if(is_null($rec))
        {
            echo "No report generated..!"; 
        }
        else
        {
            $pdf = PDF::loadview('admin/download_couse',compact('rec'));

            return $pdf->stream('CourseReport.pdf');
        }
       
        
    }
    public function generatecourse1(Request $request )
    {
        $rec = DB::table('set_sub_fac_stu')
         ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
         ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
         ->select('*')
         ->where('subject_models.subject_name', 'LIKE',  $request->subject_name)
        //  ->where('add_faculty_models.faculty_name', 'LIKE', $request->faculty_name) 
        // //  ->where('set_sub_fac_stu.total_lec', '=',$request->total_lec)
         ->get();
         
        if(is_null($rec))
        {
            echo "No report generated..!"; 
        }
        else
        {
            $pdf = PDF::loadview('admin/download_couse',compact('rec'));

            return $pdf->stream('CourseReport.pdf');
        }
       
        
    }
    
    public function showcours()
    {
        $rec = DB::table('set_sub_fac_stu')
         ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
         ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
         ->select('*')
         ->get();
         

        // $pdf = PDF::loadview('admin/generatecoursreport',compact('rec'));

        return view('admin/coursr',compact('rec'));
        
    }
    
    public function viewcoursedata()
    {
        $data = DB::table('set_sub_fac_stu')
         ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
         ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
         ->select('*')
         ->get();
     
        return view('admin/viewallcourse', compact('data'));

    }
    public function sendmail(Request $request)
    {

        $users = admin_model::get()->where('deleted',0);

        $details = [
            'title' => $request->subject,
            'message' => $request->message,
        ];

        $filename = $request->file('file');
        $extension = $filename->getClientOriginalExtension();
        $newFilename = time() . '.' . $extension;
        $filename->move('mailfiles/', $newFilename);
    
        $filePath = 'mailfiles/' . $newFilename;
    
        foreach ($users as $user) 
        {

            Mail::to($user->email)->send(new SendAttachmentMail($details, $filePath));
    
        }

        echo 'Email Sent Successfully!';

        return view('admin/mail_send')->with('success','Email Sent Successfully!');
    
    }

    public function sendmailuser(Request $request)
    {

        $users = user_email_model::get()->where('deleted',0);

        $details = [
            'title' => $request->subject,
            'message' => $request->message,
        ];

        $filename = $request->file('file');
        $extension = $filename->getClientOriginalExtension();
        $newFilename = time() . '.' . $extension;
        $filename->move('mailfiles/', $newFilename);
    
        $filePath = 'mailfiles/' . $newFilename;
    
        foreach ($users as $user) 
        {

            Mail::to($user->email)->send(new SendAttachmentMail($details, $filePath));
    
        }

        echo 'Email Sent Successfully!';

        return view('admin/mail_send')->with('success','Email Sent Successfully!');
    
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
            'pdf' => 'required',
            'date' => 'required',
            'sem' => 'required',
      ]);

      $filename = $request->file('pdf');
      $extension = $filename->getClientOriginalExtension();
      $newFilename = time() . '.' . $extension;
      $filename->move('TimeTables/', $newFilename);

      $rec = new upload_time_table();
      $rec->date = $request->date;
      $rec->sem = $request->sem;
      $rec->description = $request->description;
      $rec->path ='TimeTables/' . $newFilename;
      $rec->save();
  
      return redirect('/upload_ttm')->with('success','Time table successfully uploaded :- ');
    }

    public function viewttm()
    {
        $documents = upload_time_table::get();

        return view('admin/view_ttm', compact('documents'));
    }

    public function delete_ttm($id)
    {

        DB::table('upload_time_table')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Timetable deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
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
