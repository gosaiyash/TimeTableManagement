<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\add_faculty_model;
use DB;

class add_faculty_controller extends Controller
{
    public function show()
    {
       $rec = add_faculty_model::get()->where('deleted', 0);

      // return view("/viewfaculty",compact('rec'));

      return view('admin/view_faculty', compact('rec'));

       //return view('/viewfaculty')->with('/viewfaculty', $rec);

    }
    
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
                'faculty_code' => 'required | min:4 | max:6',
                'faculty_name' => 'required',
                'email' => 'required',
                'faculty_mo' => 'required | min:10 | max:10',
                
            ]);

        $rec = new add_faculty_model();
        $rec->faculty_code = $request->faculty_code;
        $rec->faculty_name = $request->faculty_name;
        $rec->faculty_mo = $request->faculty_mo;
        $rec->email = $request->email;
       

        $rec->save();

        return redirect('/add_faculty')->with('faculty','Faculty added successfully');

    }
    public function updatefacshow(Request $request)
    {
       
       $rec = add_faculty_model::where('f_id', $request->id)->first();

       return view('admin/update_faculty', compact('rec'));
    }

    public function updatefac(Request $request)
    {
       
       $rec = add_faculty_model::where('f_id', $request->id)->first();

       DB::update('update add_faculty_models set faculty_code = ? ,faculty_name =?,faculty_mo=?,email=? where f_id =?',[$request->faculty_code,$request->faculty_name,$request->faculty_mo,$request->email,$request->id]);

       return redirect('/viewfaculty')->with('faculty','Faculty profile successfully updated:-');

    }
   
    public function facdelete($id)
    {
        $set=1;
        DB::update('update add_faculty_models set deleted = ?  where f_id =?',[$set,$id]);

        return redirect('/viewfaculty')->with('faculty','Faculty successfully Deleted!:-');
    }




    
}
