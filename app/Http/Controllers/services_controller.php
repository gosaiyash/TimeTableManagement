<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services_model;
use Session;
use DB;

class services_controller extends Controller
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
        echo $request->img;
        $filename = $request->file('img');
        $extension = $filename->getClientOriginalExtension();
        $newFilename = time() . '.' . $extension;
        $filename->move('MyImages/', $newFilename);

        $rec = new services_model();
        $rec->s_name = $request->s_name;
        $rec->description = $request->description;
        $rec->image ='MyImages/' . $newFilename;
        $rec->save();

        return redirect('/add_services')->with('success','Services successfully added');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $rec = services_model::get()->where('deleted', 0);

        return view('admin/view_services' , compact('rec'));
    }

    public function services_update($id)
    {
        $rec = services_model::where('id', $id)->first();

        return view('admin/update_services' , compact('rec'));
      
    }

    public function services_delete($id)
    {
        $set=1;
        DB::update('update services set deleted = ?  where id =?',[$set,$id]);
        return redirect('/view_services')->with('success','Services successfully Deleted!:-');
  
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
    public function update(Request $request)
    {
        if($request->img != null)
        {
            $filename = $request->file('img');
            $extension = $filename->getClientOriginalExtension();
            $newFilename = time() . '.' . $extension;
            $filename->move('MyImages/', $newFilename);
            $uimg = 'MyImages/' . $newFilename;
            DB::update('update services set s_name = ? ,description =?,image=? where id =?',[$request->s_name,$request->description,$request->$uimg ,$request->id]);
        }
        else
        {
            DB::update('update services set s_name = ? ,description =? where id =?',[$request->s_name,$request->description,$request->id]);
      
        }

        return redirect('/view_services')->with('success','Services successfully updated:-');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
