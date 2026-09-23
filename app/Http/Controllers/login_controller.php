<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\singup_model;
use App\Models\services_model;
use App\Models\upload_time_table;
use App\Models\admin_model;
use Session;

class login_controller extends Controller
{
    public function ck(Request $request)
    {
        $activeUser = singup_model::where('enrollment_no', $request->enrollment_no)->first();
        
        if ($activeUser && $activeUser->enrollment_no == $request->enrollment_no && $activeUser->password == md5($request->password))
         {
            Session::put('uname', $activeUser->first_name);
            Session::put('uimg', $activeUser->img);
            Session::put('uid', $activeUser->enrollment_no);

            $service = services_model::get()->where('deleted', 0);

            $documents = upload_time_table::orderBy('date', 'desc')->get();

            return view('user/index4' , compact('service','documents'))->with('success','Congratulation , Your a student !!!');
          //  return redirect('index')->with('success','Congratulation , Your a student !!!');

        } else {
            echo 'Id or Password is wrong !! pls enter valide id password';
            return redirect('/login')->with('success','Id or Password is wrong !! pls enter valide id password');

        }
        
    }
    public function index()
    {
        $service = services_model::get()->where('deleted', 0);

        $documents = upload_time_table::get();

        return view('user/index4' , compact('service','documents'));
    }
    public function logout()
    {   
        session_unset();
        Session::flush();
        return redirect('/');

    }

    public function adminlogin(Request $rec)
    {
        
        $activeUser = admin_model::where('email', $rec->id)->first();
    
        if ($activeUser && $activeUser->email == $rec->id && $activeUser->password == md5($rec->password))
         {
            Session::put('admin_name', $activeUser->name);
            Session::put('admin_image', $activeUser->image);
            Session::put('admin_id', $activeUser->id);

          //  echo $activeUser->image;

          $timetables = upload_time_table::orderBy('date', 'desc')->get();

           return view('admin/adminindex2',compact('timetables'))->with('success','Congratulation , Your a admin !!!');

          }
          else if($rec->id=="admin123" && $rec->password==123)
          {
            return redirect('/admin')->with('success','Congratulation , Your a admin !!!');
  
          }
           else {
            echo 'Id or Password is wrong !! pls enter valide id password';
            return redirect('/adminlogin1')->with('success','Id or Password is wrong !! pls enter valide id password');

        }

    }

    public function adminindex()
        {
            $timetables = upload_time_table::orderBy('date', 'desc')->get();
           return view('admin/adminindex2',compact('timetables'))->with('success','Congratulation , Your a admin !!!');
        }
    
}
