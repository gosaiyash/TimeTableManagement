<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject_model;
use DB;

class subject_controller extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        // $request->valdate
        // ([

        // ]);

        if(is_null($request->deleted))
        {
            $delete = 0;
        }
        else{
            $delete = $request->deleted;
        }

        $rec = new subject_model();
        $rec->subject_code = $request->subject_code;
        $rec->subject_name = $request->subject_name;
        $rec->total_lectures = $request->total_lectures;
        $rec->deleted = $delete;

        $rec->save();

        return redirect('/add_subject')->with('subjectadd','Subject added successfully');

    }
    public function show()
    {
       $rec = subject_model::get()->where('deleted', 0);

      return view('admin/view_subject', compact('rec'));

    }
    public function subupdate(Request $request)
    {
        DB::update('update subject_models set subject_code = ? ,subject_name =?,total_lectures=? where id =?',[$request->subject_code,$request->subject_name,$request->total_lectures,$request->id]);

        return redirect('/viewsubject')->with('update','Subject successfully Updated!');

    }
    public function deletesub($id)
    {
        DB::update('update subject_models set deleted =? where id =?',[1,$id]);

        return redirect('/viewsubject')->with('update','Subject successfully Deleted!');

    }
    public function updatesub($id)
    {
       $rec = subject_model::where('id', $id)->first();
     
       return view("admin/update_sub",compact('rec'));
    }
}
