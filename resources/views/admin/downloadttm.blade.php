<?php

namespace App\Http\Controllers;
use DB;
use App\Models\temptimetablemodel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;

class temptimetablecontroller extends Controller
{
    public function sortsubject()
    {
        $i=0;
        $j=0;
        $classchangetime=5;
        $avgtime = 50;
        $rec = DB::table('set_sub_fac_stu')
        ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
        ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
        ->select('*')
        ->orderBy('total_lec', 'asc')
        ->take(3)
        ->get();
        
        foreach($rec as $rec1)
        {
           // echo $rec1->total_lec . " ";
        }

        $chk = DB::table('temptimetable')
             ->select('*')
             ->where('deleted',0)
             ->get();

        
        
        foreach($chk as $check)
        {
            $i=1;
        }

        if(($i!=1))
        {
            $rec = DB::table('set_sub_fac_stu')
            ->select('*')
            ->orderBy('total_lec', 'desc')
            ->take(3)
            ->get();

                
            $newstarttime = random_int(8,12);
           
            $newtime = $newstarttime;
            $a=0;

            $hours2 =  $newtime;
            $minutes2 = 00;
        
            // Total minutes
            $totalMinutes =($hours2 * 60 + $minutes2);
        
            // Convert back to hours and minutes
            $finalHours = floor($totalMinutes / 60);
            $finalMinutes = $totalMinutes % 60;
            $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
            $Result = $finalHours . ' : ' . $finalMinutes;

            foreach($rec as $rec1)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $rec1->id;
                $rec->no = 1;
                if($a==0)
                    {
                        $rec->time = $Result;
                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                        $rec->end_time=$Result1;
                        $a=1;
                        $rec->save();
                    }
                    else
                    {
                        [$hours, $minutes1] = explode(':', $result1);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 +5;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $Result = $finalHours . ' : ' . $finalMinutes;
                        $rec->time = $Result;

                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                        $rec->end_time=$Result1;
                        $rec->save();
                    }

                $rec->save();

                $total=$rec1->total_lec-1;

                DB::update('update set_sub_fac_stu set remain_lec = ?  where id =?',[$total,$rec1->id]);

            }
        }
        else
        {
            $oldno=$data = DB::table('temptimetable')
            ->select('id','no')
            ->latest('no')
            ->take(1)
            ->get();

            foreach($oldno as $old_no)
            {
                $old_no1=$old_no->no;
            }
            
            $data = DB::table('temptimetable')
            ->select('id','no','time')
            ->where('no','=',$old_no1)
            ->get();
          

            $k=0;

            foreach($data as $data1)
            {
                $j=$j+1;
                $no=$data1->no+1;

                if($k == 0)
                {
                    $starttime = $data1->time;

                    $k=1;
                }
            }
         
            $newstarttime = random_int(8,12);

            $newtime = $newstarttime;
            $a=0;

            $hours2 =  $newtime;
            $minutes2 = 00;
        
            // Total minutes
            $totalMinutes =($hours2 * 60 + $minutes2);
        
            // Convert back to hours and minutes
            $finalHours = floor($totalMinutes / 60);
            $finalMinutes = $totalMinutes % 60;
            $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
            
        
            if($j==3)
            {
                $rec = DB::table('set_sub_fac_stu')
                        ->select('*')
                        ->orderBy('total_lec', 'desc')
                        ->take(5)
                        ->get();

                foreach($rec as $rec1)
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $rec1->id;
                    $rec->no = $no;
                    
                    if($a==0)
                    {
                        $rec->time = $result;
                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                       
                        $rec->end_time=$result1;
                        
                        $a=1;
                        $rec->save();
                    }
                    else
                    {
                        [$hours, $minutes1] = explode(':', $result1);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 +5;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->time = $result;

                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->end_time=$result1;
                        $rec->save();
                    }

                    $rec->save();
                    $total=$rec1->total_lec-1;

                    DB::update('update set_sub_fac_stu set remain_lec = ?  where id =?',[$total,$rec1->id]);
    
                }
               
            }
            else if($j==5 || $j>3)
            {
                $rec = DB::table('set_sub_fac_stu')
                        ->select('*')
                        ->orderBy('total_lec', 'asc')
                        ->take(3)
                        ->get();

                foreach($rec as $rec1)
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $rec1->id;
                    $rec->no = $no;
                    if($a==0)
                    {
                        $rec->time = $result;
                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->end_time=$result1;
                        $a=1;
                        $rec->save();
                    }
                    else
                    {
                        [$hours, $minutes1] = explode(':', $result1);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 +5;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->time = $result;

                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->end_time=$result1;
                        $rec->save();
                    }

                    $rec->save();
                    $total=$rec1->total_lec-1;

                    DB::update('update set_sub_fac_stu set remain_lec = ?  where id =?',[$total,$rec1->id]);
                }
               
            }
            else if($j<3)
            {
                $rec = DB::table('set_sub_fac_stu')
                        ->select('*')
                        ->orderBy('total_lec', 'desc')
                        ->take(5)
                        ->get();

                foreach($rec as $rec1)
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $rec1->id;
                    $rec->no = $no;
                    if($a==0)
                    {
                        $rec->time = $result;
                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->end_time=$result1;
                        $a=1;
                        $rec->save();
                    }
                    else
                    {
                        [$hours, $minutes1] = explode(':', $result1);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 +5;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->time = $result;

                        [$hours, $minutes1] = explode(':', $result);
                        $hours2 = $hours;
                        $minutes2 = $minutes1 + 50;
                        // Total minutes
                        $totalMinutes =($hours2 * 60 + $minutes2);
                        // Convert back to hours and minutes
                        $finalHours = floor($totalMinutes / 60);
                        $finalMinutes = $totalMinutes % 60;
                        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
                        $rec->end_time=$result1;
                        $rec->save();

                    }

                    $rec->save();
                    $total=$rec1->total_lec-1;

                    DB::update('update set_sub_fac_stu set remain_lec = ?  where id =?',[$total,$rec1->id]);
    
                }
               
            }

        }

        $dataget = temptimetablemodel::get();

        $ttm =  DB::table('temptimetable as t1')
        ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
        ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
        ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
        ->where('t1.no', $no)
        ->get();

       

        $nextDay = Carbon::now()->addDay();

        if ($nextDay->isSunday()) {
            $nextDay = $nextDay->addDay(); // Go to Monday
        } 


       
         $pdf = PDF::loadview('admin/view_timetable',compact('ttm') , compact('nextDay'));

         return $pdf->stream($nextDay . '.pdf');

    }
}
