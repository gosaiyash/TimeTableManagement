<?php

namespace App\Http\Controllers;
use DB;
use App\Models\temptimetablemodel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class temptimetablecontroller extends Controller
{
    public function generatettm()
    {
        $letters = range('A', 'Z');
        $i = 0;
        $no=0;

        $oldno = DB::table('temptimetable')
            ->select('id','no')
            ->latest('no')
            ->take(1)
            ->get();

            foreach($oldno as $no1)
            {
                $no=$no1->no;
            }

            $no+1;

            $da=0;
            $db=0;
            $dc=0;
            $dd=0;

        while ($i != 4) 
        {
           

            if($this->isgenerated())
            {
               // echo "not found";

                $data = DB::table('set_sub_fac_stu')
                        ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                        ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                        ->select('*')
                        ->take(3)
                        ->orderBy('total_lec', 'asc')
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
                       
            
                        foreach($data as $rec1)
                        {
                            $rec = new temptimetablemodel();
                            $rec->fs_id = $rec1->id;
                            $rec->no = 1;
                            $da=1;
                            $rec->division=$letters[$i];
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
                if($this->isdivfound($letters[$i]))
                {
                    echo "Not found for this div!";

                    
                $data = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->orderBy('total_lec', 'asc')
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
               
    
                foreach($data as $rec1)
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $rec1->id;
                    $rec->no = $no + $i;
                    $da = $no + $i +1;
                    $rec->division=$letters[$i];
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
                    //echo "found for this div!";

                    $divlastlectures = DB::table('temptimetable')
                            ->select('id','no')
                            ->where('division',$letters[$i])
                            ->latest('no')
                            ->take(1)
                            ->get();

                            $divlastlecturesno=-1;

                            foreach($divlastlectures as $divlastlecture)
                            {
                                $divlastlecturesno=$divlastlecture->no;
                            }

                    
                    //COUNT prev lectures
                    
                    if($divlastlecturesno!=-1)
                    {
                        $count_lectures = DB::table('temptimetable')
                            ->where('division', $letters[$i])
                            ->where('no',$divlastlecturesno)
                            ->latest('no')
                            ->count();

                    }
                    else
                    {
                        $count_lectures =0;
                    }

                    echo $count_lectures;

                    //Check all division time and subject same || not same
                    
                    if(true)
                    {
                        if($i==0) //Div A
                        {
                            if($count_lectures == 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                    ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                    ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                    ->select('*')
                                    ->take(5)
                                    ->orderBy('total_lec', 'asc')
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
                                   
                                foreach($data as $rec1)
                                {
                                    $rec = new temptimetablemodel();
                                    $rec->fs_id = $rec1->id;
                                    $rec->no = $no + $i +1;
                                    $da=$no +$i  +1;
                                    $rec->division=$letters[$i];
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
                                            $Result1 = $finalHours . ' : ' . $finalMinutes;
                                            $rec->end_time=$Result1;
                                            $rec->save();
                                        }  
                                }
                           
                            }
                            else if($count_lectures  > 7)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
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
                               
                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $da=$no +$i  +1;
                                $rec->division=$letters[$i];
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                       
                                        $rec->save();
                                        
                                    }  
                            }
                       
                            }
                            else if($count_lectures > 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
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
                               
                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $da=$no +$i  +1;
                                $rec->division=$letters[$i];
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        $rec->save();
                                    }  
                            }
                       
                            }
                            else if($count_lectures < 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(6)
                                ->orderBy('total_lec', 'asc')
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
                                
                                foreach($data as $rec1)
                                {
                                    $rec = new temptimetablemodel();
                                    $rec->fs_id = $rec1->id;
                                    $rec->no = $no + $i+1;
                                    $da=$no +$i  +1;
                                    $rec->division=$letters[$i];
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
                                            $Result1 = $finalHours . ' : ' . $finalMinutes;
                                            $rec->end_time=$Result1;
                                            $rec->save();
                                        }  
                                }
                            }
                            else
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(5)
                                ->orderBy('total_lec', 'asc')
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
                               
                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i +1;
                                $da=$no +$i  +1;
                                $rec->division=$letters[$i];
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        $rec->save();
                                    }  
                            }
                       
                            }
                       
                        }
                        else if($i==1) //Div B
                        {
                            if($count_lectures == 4)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(5)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }

                            $y=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $db = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures == 7)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }

                            $y=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $db = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures >5)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(7)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }

                            $y=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $db = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures < 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(7)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }

                            $y=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $db = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }

                            $y=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $db = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)
                                        {
                                            echo "Ssme lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                        }
                        else if($i==2) //Div C
                        {
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
                            ->get();

                            $ttm_data2 = DB::table('temptimetable')
                            ->where('division', 'B')
                            ->latest('no')
                            ->get();

                            if($count_lectures == 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(5)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dc = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures ==5)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dc = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                    }
                                    
                            }
                            }
                            else if($count_lectures > 5)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dc = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                    }
                                    
                            }
                            }
                            else if($count_lectures < 3)
                            {   
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(7)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dc = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                    }
                                    
                            }
                            }
                            else
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(5)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dc = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if(($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result)  || ($subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result))
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                    }
                                    
                            }
                            }


                        }
                        else if($i==3) //Div D
                        {
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
                            ->get();

                            $ttm_data2 = DB::table('temptimetable')
                            ->where('division', 'B')
                            ->latest('no')
                            ->get();

                            $ttm_data3 = DB::table('temptimetable')
                            ->where('division', 'C')
                            ->latest('no')
                            ->get();

                            if($count_lectures == 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(5)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            $x3=0;
                            foreach($ttm_data3 as $subject3)
                            {
                                $subjct_data3[] = [
                                    'fs_id' => $subject3->fs_id,
                                    'time' => $subject3->time,
                                ];
                                $x3=$x3+1;
                            }
                            $y3=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dd = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id&& $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures == 5)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(3)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            $x3=0;
                            foreach($ttm_data3 as $subject3)
                            {
                                $subjct_data3[] = [
                                    'fs_id' => $subject3->fs_id,
                                    'time' => $subject3->time,
                                ];
                                $x3=$x3+1;
                            }
                            $y3=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dd = $no + $i+1;
                               
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures > 5)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(7)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            $x3=0;
                            foreach($ttm_data3 as $subject3)
                            {
                                $subjct_data3[] = [
                                    'fs_id' => $subject3->fs_id,
                                    'time' => $subject3->time,
                                ];
                                $x3=$x3+1;
                            }
                            $y3=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dd = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else if($count_lectures < 3)
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(7)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            $x3=0;
                            foreach($ttm_data3 as $subject3)
                            {
                                $subjct_data3[] = [
                                    'fs_id' => $subject3->fs_id,
                                    'time' => $subject3->time,
                                ];
                                $x3=$x3+1;
                            }
                            $y3=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dd = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
                                    }
                                    
                            }
                       
                            }
                            else
                            {
                                $data = DB::table('set_sub_fac_stu')
                                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                                ->select('*')
                                ->take(5)
                                ->orderBy('total_lec', 'asc')
                                ->get();
                            $ttm_data1 = DB::table('temptimetable')
                            ->where('division', 'A')
                            ->latest('no')
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
                           
                            $x=0;
                            foreach($ttm_data1 as $subject)
                            {
                                $subjct_data[] = [
                                    'fs_id' => $subject->fs_id,
                                    'time' => $subject->time,
                                ];

                                $x=$x+1;
                            }
                            $y=0;

                            $x2=0;
                            foreach($ttm_data2 as $subject2)
                            {
                                $subjct_data2[] = [
                                    'fs_id' => $subject2->fs_id,
                                    'time' => $subject2->time,
                                ];

                                $x2=$x2+1;
                            }
                            $y2=0;

                            $x3=0;
                            foreach($ttm_data3 as $subject3)
                            {
                                $subjct_data3[] = [
                                    'fs_id' => $subject3->fs_id,
                                    'time' => $subject3->time,
                                ];
                                $x3=$x3+1;
                            }
                            $y3=0;

                            foreach($data as $rec1)
                            {
                                $rec = new temptimetablemodel();
                                $rec->fs_id = $rec1->id;
                                $rec->no = $no + $i+1;
                                $dd = $no + $i+1;
                                $rec->division=$letters[$i];
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
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                           // echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
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
                                        $Result1 = $finalHours . ' : ' . $finalMinutes;
                                        $rec->end_time=$Result1;
                                        if($subjct_data[$y]['fs_id'] == $rec1->id && $subjct_data[$y]['time'] == $result  || $subjct_data2[$y2]['fs_id'] == $rec1->id && $subjct_data2[$y2]['time'] == $result || $subjct_data3[$y3]['fs_id'] == $rec1->id && $subjct_data3[$y3]['time'] == $result)
                                        {
                                            echo "Same lecture found";
                                        }
                                        else
                                        {
                                            $rec->save();
                                        }
                                        
                                        if($y < $x)
                                        {
                                            $y=$y+1;
                                        }
                                        if($y2 < $x2)
                                        {
                                            $y2=$y2+1;
                                        }
                                        if($y3 < $x3)
                                        {
                                            $y3=$y3+1;
                                        }
                                    }
                                    
                            }
                       
                            }

                        }
                        else
                        {
                            echo "En Error :-20002 Error Found in logical section !";
                        }
                                 
                    }
                }
            }
         $i = $i + 1;
        }

        echo "Time Table Succsessfully Generated !";

        $ttm_no = DB::table('temptimetable')
            ->select('id', 'no')
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $old_no) {
            $ttmno = $old_no->no;
        }

       // echo $ttmno;

        //D
        $ttm4 = DB::table('temptimetable as t1')
        ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
        ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
        ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
        ->where('t1.no', $dd)
        ->get();
        //C
            foreach($ttm4 as $t4)
            {
                echo $t4->division;
            }

        $ttm3 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $dc)
            ->get();

            foreach($ttm3 as $t3)
            {
                echo $t3->division;
            }
        //B
        $ttm2 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $db)
            ->get();

            foreach($ttm2 as $t2)
            {
                echo $t2->division;
            }
        //A
        $ttm1 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $da)
            ->get();

            foreach($ttm1 as $t1)
            {
                echo $t1->division;
            }

        $nextDay = Carbon::now()->addDay();

        if ($nextDay->isSunday()) {
            $nextDay = $nextDay->addDay(); // Go to Monday
        }

        return view('admin/view_timetable', compact('ttm1','ttm2','ttm3','ttm4','nextDay'));

    }
    public function isgenerated()
    {
        $i=0;
        $chk = DB::table('temptimetable')
            ->select('*')
            ->where('deleted', 0)
            ->get();

        foreach ($chk as $check) {
            $i = 1;
        }

        if ($i != 0) {
            return false;
        } else {
            return true;
        }
    }

    public function isdivfound($div)
    {
        $i=0;
        $chk = DB::table('temptimetable')
            ->select('*')
            ->where('deleted', 0)
            ->where('division', $div)
            ->get();

        foreach ($chk as $check) {
            $i = 1;
        }

        if ($i != 0) {
            return false;
        } else {
            return true;
        }
    }

    function downloadttm()
    {

        $oldno = $data = DB::table('temptimetable')
            ->select('id', 'no')
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $old_no) {
            $no = $old_no->no;
        }


        $dataget = temptimetablemodel::get();

        $ttm1 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $no)
            ->get();

        $nextDay = Carbon::now()->addDay();

        if ($nextDay->isSunday()) {
            $nextDay = $nextDay->addDay(); // Go to Monday
        }

        $pdf = PDF::loadview('admin/view_timetable', compact('ttm1'), compact('nextDay'));

        return $pdf->stream($nextDay . '.pdf');


    }
}

/*
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

        if ($nextDay->isSunday()) {
            $nextDay = $nextDay->addDay(); // Go to Monday
        } 
       
         return  view('admin/view_timetable',compact('ttm') , compact('nextDay'));

*/
