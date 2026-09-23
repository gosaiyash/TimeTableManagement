<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\singup_model;
use App\Models\admin_model;
use Session;
use DB;
use App\Models\user_email_model;
use App\Models\services_model;

class singup_controller extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'enrollment_no' => 'required | min:14', //23004500210081
            'password' => 'required',
            'email' => 'required',
            'birthdate' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'sem' => 'required',
      ]);


        $enrollment_nock = singup_model::where('enrollment_no','=', $request->enrollment_no)->first();

        if(is_null($enrollment_nock))
        {
            $filename = $request->file('student_img');
            $extension = $filename->getClientOriginalExtension();
            $newFilename = time() . '.' . $extension;
            $filename->move('MyImages/', $newFilename);
    
            $rec = new singup_model();
            $rec->enrollment_no = $request->enrollment_no;
            $rec->first_name = $request->firstname;
            $rec->last_name = $request->lastname;
            $rec->email = $request->email;
            $rec->birthdate = $request->birthdate;
            $rec->sem = $request->sem;
            $rec->password = md5($request->password);
            $rec->img ='MyImages/' . $newFilename;
            $rec->save();
    
            return redirect('/login')->with('success','Your data saved successfully :- Pls login !');
    
        }
        else
        {
            return redirect('/singup')->with('success','Enrollment Number already exist!');
            
        }
             
    }

    public function admin_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'cpassword' => 'required',
            'admin_img' => 'required',
      ]);

      

        $filename = $request->file('admin_img');
        $extension = $filename->getClientOriginalExtension();
        $newFilename = time() . '.' . $extension;
        $filename->move('MyImages/', $newFilename);

        $rec = new admin_model();
        $rec->name = $request->name;
        $rec->email = $request->email;
        $rec->password = md5($request->cpassword);
        $rec->image ='MyImages/' . $newFilename;
        $rec->save();
    
        return redirect('/admin_r')->with('success','Account successfully Created :- ');

    }

    public function show()
    {
        $rec = singup_model::get()->where('deleted', 0);

        return view('admin/view_student' , compact('rec'));
    }

    public function getupdatedata()
    {
           $uid =  Session::get('uid');

           $rec = singup_model::where('enrollment_no', $uid)->first();

           $rec1 = user_email_model::where('id', $uid)->first();
        
        
            if ($rec && $rec->enrollment_no == $uid)
            {
                return view('user/update_student', compact('rec','rec1'));
              
            } else {
                echo 'User no found 404 !';
            }

    }

    public function adminupdate($id)
    {
        $uid= $id;
        $rec = singup_model::where('id', $uid)->first();
        
        if ($rec && $rec->id == $uid)
        {
            return view('admin/adminstud', compact('rec'));
          
        } else {
            echo 'User no found 404 !';
        }
    }

    public function studdelete($id)
    {
        $set=1;
        DB::update('update student_singup_models set deleted = ?  where id =?',[$set,$id]);

        return redirect('/viewstudent')->with('success','Student profile successfully Deleted!:-');
    }

    public function updatestud(Request $request)
    {

        $uid=$request->id;
      

        $rec = singup_model::where('id', $uid)->first();
        
        
        if($request->student_img != null)
        {
            $filename = $request->file('student_img');
            $extension = $filename->getClientOriginalExtension();
            $newFilename = time() . '.' . $extension;
            $filename->move('MyImages/', $newFilename);
            $uimg = 'MyImages/' . $newFilename;
            DB::update('update student_singup_models set first_name = ? ,last_name =?,birthdate=?,sem=?,img=?,email=? where id =?',[$request->firstname,$request->lastname,$request->birthdate,$request->sem,$uimg,$request->email,$request->id]);
        }
        else
        {
            DB::update('update student_singup_models set first_name = ? ,last_name =?,birthdate=?,sem=?,email=? where id =?',[$request->firstname,$request->lastname,$request->birthdate,$request->sem,$request->email,$request->id]);

        }

        echo 'Record updated';

        return redirect('/viewstudent')->with('success','Student profile successfully updated:-');

    }
    
    public function update(Request $request)
    {

        $uid =  Session::get('uid');
        $userimg = Session::get('uimg');

        $rec = singup_model::where('enrollment_no', $uid)->first();
        
        if($request->student_img != null )
        {
            $filename = $request->file('student_img');
            $extension = $filename->getClientOriginalExtension();
            $newFilename = time() . '.' . $extension;
            $filename->move('MyImages/', $newFilename);
            $uimg = 'MyImages/' . $newFilename;
            //DB::update('update student_singup_models set first_name = ? ,last_name =?,birthdate=?,sem=?,img=? where enrollment_no =?',[$request->firstname,$request->lastname,$request->birthdate,$request->sem,$uimg,$request->enrollment_no]);
            DB::update('update student_singup_models set first_name = ? ,last_name =?,birthdate=?,sem=?,img=?,email=? where id =?',[$request->firstname,$request->lastname,$request->birthdate,$request->sem,$uimg,$request->email,$request->enrollment_no]);
       

            Session::put('id', $request->enrollment_no);
            Session::put('pass', md5($rec->password));
           
        }
        else
        {
            DB::update('update student_singup_models set first_name = ? ,last_name =?,birthdate=?,sem=?,email=? where enrollment_no =?',[$request->firstname,$request->lastname,$request->birthdate,$request->sem,$request->email,$request->enrollment_no]);

           // DB::update('update student_singup_models set first_name = ? ,last_name =?,birthdate=?,sem=? where enrollment_no =?',[$request->firstname,$request->lastname,$request->birthdate,$request->sem,$request->enrollment_no]);
                       
            Session::put('id', $request->enrollment_no);
            Session::put('pass', md5($rec->password));
        }

        $service = services_model::get()->where('deleted', 0);

        return view('user/index4' , compact('service'))->with('success','Your profile successfully updated:-');

    }

    public function rules()
    {
        return [
            'enrollment_no' => 'required|min:13|max:13' 
        ];
    }

}
