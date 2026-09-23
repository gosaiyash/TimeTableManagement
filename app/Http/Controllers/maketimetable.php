<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use App\Models\temptimetablemodel;
use Illuminate\Http\Request;

class maketimetable extends Controller
{
     public $NO=0;
    public function isgenerated($div)
    {
        $i = 0;
        $chk = DB::table('temptimetable')
            ->select('*')
            ->where('deleted', 0)
            ->where('division', $div)
            ->get();
        foreach ($chk as $check) {
            $i = 1;
        }
        if ($i != 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getno()
    {
        $no = 0;
        $oldno = DB::table('temptimetable')
            ->select('id', 'no')
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $no1) {
            $no = $no1->no;
        }

        $no = $no + 1;

        return $no;
    }

    public function getdivno($div)
    {
        $no = 0;
        $oldno = DB::table('temptimetable')
            ->select('id', 'no')
            ->where('division',$div)
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $no1) {
            $no = $no1->no;
        }

        return $no;
    }

    public function getprettm($divno)
    {
        $no = 0;
        $oldno = DB::table('temptimetable')
            ->select('id', 'no')
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $no1) {
            $no = $no1->no;
        }

        if ($no != 0) {
            $finalno = $no - $divno;
            $data = DB::table('temptimetable as t1')
                ->where('t1.no', $finalno)
                ->get();

            $last_ttm_dataArray = [];
            foreach ($data as $d) {
                $last_ttm_dataArray[] = [
                    'fs_id' => $d->fs_id,
                ];

            }
            return $last_ttm_dataArray;
        }

    }
    public function getnewtime()
    {
        //Start time
        $newstarttime = random_int(8, 12);
        $newtime = $newstarttime;
        if($newtime == 8)
        {
            $hours2 = $newtime;
             $minutes2 = 05;
        }
        else if($newtime == 9)
        {
            $hours2 = $newtime;
             $minutes2 = 00;
        }
        else if($newtime == 10)
        {
            $hours2 = 10;
             $minutes2 = 50;
        }
        else if($newtime == 11)
        {
            $hours2 = 11;
             $minutes2 = 45;
        }
        else if($newtime == 12)
        {
            $hours2 = 12;
             $minutes2 = 40;
        }
       
        // Total minutes
        $totalMinutes = ($hours2 * 60 + $minutes2);
        // Convert back to hours and minutes
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);

        //End time
        [$hours, $minutes1] = explode(':', $result);
        $hours2 = $hours;
        $minutes2 = $minutes1 + 50;
        // Total minutes
        $totalMinutes = ($hours2 * 60 + $minutes2);
        // Convert back to hours and minutes
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;

       

        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);

        $time = [
            'start' => $result,
            'end' => $result1,
        ];

        return $time;
    }
    public function gettime($array_time)
    {
        $h = $array_time['end'];
        [$hours, $minutes1] = explode(':', $h);
        $hours2 = $hours;
        $minutes2 = $minutes1 + 05;
        // Total minutes
        $totalMinutes = ($hours2 * 60 + $minutes2);
        // Convert back to hours and minutes
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);

        //End time
        [$hours, $minutes1] = explode(':', $result);
        $hours2 = $hours;
        $minutes2 = $minutes1 + 50;
        // Total minutes
        $totalMinutes = ($hours2 * 60 + $minutes2);
        // Convert back to hours and minutes
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);

        $time = [
            'start' => $result,
            'end' => $result1,
        ];

        return $time;
    }
    public function generatettm()// Main function 
    {
        $no = 0;
        $oldno = DB::table('temptimetable')
            ->select('id', 'no')
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $no1) {
            $no = $no1->no;
        }

        $no = $no + 1;

        $letters = range('A', 'Z');
        $i = 0;

        $this->generatefordiv($letters[0], 0);
        $this->generatefordiv($letters[1], 1);
        $this->generatefordiv($letters[2], 2);
        $this->generatefordiv($letters[3], 3);

        $no = $this->getdivno($letters[3]);

        $nextDay = Carbon::now()->addDay();

        if ($nextDay->isSunday()) {
            $nextDay = $nextDay->addDay(); // Go to Monday
        }

        $ano = $no -3;
        $bno = $no -2;
        $cno = $no -1;
        $dno1 = $no;
        //return view('admin/view_timetable', compact('no','nextDay'));

        return view('admin/view_timetable', compact('ano','bno','cno','dno1','nextDay'));
 
    }
    public function generatefordiv($div, $lec_no_sub)
    {
        $no = 0;
        if ($div == 'A') {

            $notzero = DB::table('set_sub_fac_stu')
                        ->where('Remain_A', '>', 0)
                        ->exists();
            if($notzero) 
            {
                $no = $this->divA($div, $lec_no_sub);
                $this->NO = $no;
            }           
           
        } else if ($div == 'B') {
            $notzero = DB::table('set_sub_fac_stu')
                        ->where('Remain_B', '>', 0)
                        ->exists();
            if($notzero) 
            {
                $no = $this->divB($div, $lec_no_sub); 
                $this->NO = $no; 
            } 
                    
        } else if ($div == 'C') {
            $notzero = DB::table('set_sub_fac_stu')
                        ->where('Remain_C', '>', 0)
                        ->exists();
            if($notzero) 
            {   
                $no = $this->divC($div, $lec_no_sub); 
                $this->NO = $no;
            } 
           
        } else if ($div == 'D') {
            $notzero = DB::table('set_sub_fac_stu')
                        ->where('Remain_D', '>', 0)
                        ->exists();
            if($notzero) 
            {
                $no = $this->divD($div, $lec_no_sub); 
                $this->NO = $no;
            } 
            
        } else {
            echo "Error : -20001 Out of rang division found !";
        }

    }

    

    public function divA($div, $lec_no_sub)
    {
        $no = $this->getno();
        $ano = $this->getdivno('A');
        $i = 0;
        $last_lectures = 0;
        $o=0;
        if ($this->isgenerated($div)) // If division prev time table is exist
        {
            //find last lectures 
            $oldno = DB::table('temptimetable')
                ->select('fs_id', 'no')
                ->latest('no')
                ->take(1)
                ->get();

            $last_lec_data = [];
            foreach ($oldno as $no1) {
                $no = $no1->no;
            }

            $length = count($last_lec_data);

            $last_lec = DB::table('temptimetable')
                ->where('no', $ano)
                ->count('*');

            // echo "Last lectures : " . $last_lec . " -> ";
            //End last lectures

            //Generate new time for lecture
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;
            //Get no
            $no = $this->getno();

            if ($last_lec < 4) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_A','!=', 0)
                    ->orderby('Remain_A', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 1)
                    ->where('Remain_A','!=', 0)
                    ->orderby('Remain_A', 'desc')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->orderby('Remain_A', 'desc')
                    ->where('Remain_A','!=', 0)
                    ->where('min_lec', 2)
                    ->take('1')
                    ->get();

                $i = 0;
                foreach ($subject_faculty_1 as $subject_faculty) {
                   
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                     
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;
                }
                foreach ($subject_faculty1 as $subject_faculty) {
                   
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i > 3 && $o==0) {
                        $time = $this->gettime($time);
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                        $o++;
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;
                }
                foreach ($subject_faculty_2 as $subject_faculty2) {
                   
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty2->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i > 3 && $o==0) {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                        $o++;
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;

                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty2->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) {
                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;
                }
            } else if ($last_lec >= 6) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->orderby('Remain_A', 'desc')
                    ->where('Remain_A','!=', 0)
                    ->take('4')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('Remain_A','!=', 0)
                    ->where('min_lec', 2)
                    ->orderby('Remain_A', 'desc')
                    ->take('1')
                    ->get();

                $i = 0;
                foreach ($subject_faculty_1 as $subject_faculty) {
                  
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                     
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;
                }
                foreach ($subject_faculty_2 as $subject_faculty2) {

                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty2->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i > 1 && $o==0) {
                        $time = $this->gettime($time);
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                        $o++;
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;

                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty2->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                    
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;
                }
            } else if ($last_lec == 4) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_A','!=', 0)
                    ->orderby('Remain_A', 'desc')
                    ->take('3')
                    ->get();

                $i = 0;
                foreach ($subject_faculty_1 as $subject_faculty) {
                  
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                       
                    } else {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];

                    }
                    $rec->save();
                    sleep(1);
                    $i++;
                }

            }

        } else {
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;

            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_A','!=', 0)
                ->orderBy('Remain_A', 'asc')
                ->take(3)
                ->get();

            $i = 0;
            foreach ($subject_faculty1 as $subject_faculty) {
                $rec = new temptimetablemodel();
                $rec->fs_id = $subject_faculty->id;
                $rec->no = $no;
                $rec->division = $div;
                if ($i == 0) {

                    $rec->time = $newtime['start'];
                    $rec->end_time = $newtime['end'];
      
                } else {
                    $time = $this->gettime($time);
                    $rec->time = $time['start'];
                    $rec->end_time = $time['end'];

                }
                $rec->save();

                sleep(2);
                $i++;
            }
        }

        return $no;
    }
      
    public function divB($div,$lec_no_sub)
    {
        $no = $this->getno();
        $ano = $this->getdivno('A');
        $bno = $this->getdivno('B');
        $i = 0;
        $last_lectures = 0;
        $newtime = [];
        $time = [];
        $newtime = $this->getnewtime();
        $time = $newtime;
        $samesubjects = [];
        $o=0;
        if ($this->isgenerated($div)) // If division prev time table is exist
        {
            
            $last_lec = DB::table('temptimetable')
                ->where('no', $bno)
                ->count('*');

            // echo "Last lectures : " . $last_lec . " -> ";
            //End last lectures

            //Generate new time for lecture
           
            //Get no
            $no = $this->getno();

            //array store same subjects
            


            if ($last_lec < 4) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_B','!=', 0)
                    ->orderby('Remain_B', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 1)
                    ->where('Remain_B','!=', 0)
                    ->orderby('Remain_B', 'desc')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('Remain_B','!=', 0)
                    ->where('min_lec', 2)
                    ->orderby('Remain_B', 'desc')
                    ->take('1')
                    ->get();

                $i = 0;
                $j = 0;
                foreach ($subject_faculty_1 as $subject_faculty) 
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) 
                    {
                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                    } 
                    else 
                    {
                        $old=$time;
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                    }
                    $exist = DB::table(table: 'temptimetable')
                    ->where('division', 'A')
                    ->where('no', $ano)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();

                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else if ($i > 1 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                          
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        $rec->save();
                        sleep(1);
                        $i++;
                    }
                    
                }
                foreach ($subject_faculty1 as $subject_faculty) {
                  
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    $old=$time;
                    $time = $this->gettime($time);
                    

                    }
                    $exist = DB::table(table: 'temptimetable')
                    ->where('division', 'A')
                    ->where('no', $ano)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();

                    if($exist)
                    {
                        if ($i == 0 && $o==0) 
                        {
                            $old=$time;
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end']; 
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else if ($i > 3 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        if ($i > 3 && $o==0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            sleep(1);
                        }
                        
                        $i++;
                }
                foreach ($subject_faculty_2 as $subject_faculty2) 
                {
                    
                    while($j > 1)
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty2->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        $old=$time;
                        $time = $this->gettime($time);
                        
                        $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $subject_faculty2->id)
                        ->where('time', $time['start'])
                        ->exists();

                        if($exist)
                        {
                            if ($i == 0 && $o==0) 
                            {
                               
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else if ($i > 3 && $o==0) 
                            {
                             
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty2->id,
                                ];
                            }
                        
                        }
                        else
                        {
                            if ($i > 3 && $o==0) 
                            {

                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                sleep(1);
                            }
                            $i++;
                        }

                        $i++;
                        $j++;
                    }

                }
            } else if ($last_lec >= 6) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_B','!=', 0)
                    ->orderby('Remain_B', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('Remain_B','!=', 0)
                    ->where('min_lec', 2)
                    ->orderby('Remain_B', 'desc')
                    ->take('1')
                    ->get();

                    $i = 0;
                    $j = 0;
                    $o=0;
                    foreach ($subject_faculty_1 as $subject_faculty) 
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        if ($i == 0) 
                        {
                            $rec->time = $newtime['start'];
                            $rec->end_time = $newtime['end'];
                          
                        } 
                        else 
                        {
                            $old=$time;
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        }
                        $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $subject_faculty->id)
                        ->where('time', $time['start'])
                        ->exists();
    
                        if($exist)
                        {
                            if ($i == 0 && $o++) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else if ($i > 1 && $o==0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
               
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
                           
                        }
                        else
                        {
                            $rec->save();
                            sleep(1);
                            $i++;
                        }
                        
                    }
                    foreach ($subject_faculty_2 as $subject_faculty2) 
                    {
                        
                        while($j > 1)
                        {
                            $rec = new temptimetablemodel();
                            $rec->fs_id = $subject_faculty2->id;
                            $rec->no = $no;
                            $rec->division = $div;
                            $old=$time;
                            $time = $this->gettime($time);
                            
                            $exist = DB::table(table: 'temptimetable')
                            ->where('division', 'A')
                            ->where('no', $ano)
                            ->where('fs_id', $subject_faculty2->id)
                            ->where('time', $time['start'])
                            ->exists();
    
                            if($exist)
                            {
                                if ($i == 0 && $o==0) 
                                {
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else if ($i > 3 && $o==0) 
                                {
    
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else
                                {
                                    $time=$old;
                                    $samesubjects[] = [
                                        'fs_id' => $subject_faculty2->id,
                                    ];
                                }
                            
                            }
                            else
                            {
                                if ($i > 3 && $o==0) 
                                {
    
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                           
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else
                                {
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                                    $rec->save();
                                    sleep(1);
                                }
                                $i++;
                            }
    
    
                            $i++;
                            $j++;
                        }
                }
            } else if ($last_lec == 4) 
            {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_B','!=', 0)
                    ->orderby('Remain_B', 'desc')
                    ->take('3')
                    ->get();

                    $i = 0;
                    $j = 0;
                    $o=0;
                    foreach ($subject_faculty_1 as $subject_faculty) 
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        if ($i == 0) 
                        {

                            $rec->time = $newtime['start'];
                            $rec->end_time = $newtime['end'];
                            
                        } 
                        else 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        }

                        $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $subject_faculty->id)
                        ->where('time', $time['start'])
                        ->exists();
    
                        if($exist)
                        {
                            if ($i == 0 && $o==0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 1 && $o==0) 
                            {
    
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
                           
                        }
                        else
                        {
                            $rec->save();
                            sleep(1);
                            $i++;
                        }
                        
                    }     
            }else
            {

            }

            $lengthofsamesubjects = count($samesubjects);
            $y=0;

            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $subject_faculty->id;
                $rec->no = $no;
                $rec->division = $div;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $samesubjects[$y]['fs_id'])
                        ->where('time', $time['start'])
                        ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                
                $y++;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $subject_faculty->id;
                $rec->no = $no;
                $rec->division = $div;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $samesubjects[$y]['fs_id'])
                        ->where('time', $time['start'])
                        ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                
                $y--;
            }
            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $subject_faculty->id;
                $rec->no = $no;
                $rec->division = $div;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $samesubjects[$y]['fs_id'])
                        ->where('time', $time['start'])
                        ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                
                $y++;
            }

        } else {
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;

            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_B','!=', 0)
                ->orderBy('Remain_B', 'asc')
                ->take(3)
                ->get();

                $i = 0;
                $j = 0;
                $o=0;
                foreach ($subject_faculty1 as $subject_faculty) 
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) 
                    {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                     
                    } 
                    else 
                    {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                    }
                    $exist = DB::table(table: 'temptimetable')
                    ->where('division', 'A')
                    ->where('no', $ano)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();

                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                          
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 1 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                   
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        $rec->save();
                        sleep(1);
                        $i++;
                    }
                    
                }
            $lengthofsamesubjects = count($samesubjects);
            $y=0;

            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $samesubjects[$y]['fs_id'])
                        ->where('time', $time['start'])
                        ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                
                $y++;
            }

            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $samesubjects[$y]['fs_id'])
                        ->where('time', $time['start'])
                        ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                
                $y--;
            }
            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id =$samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->where('no', $ano)
                        ->where('fs_id', $samesubjects[$y]['fs_id'])
                        ->where('time', $time['start'])
                        ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                
                $y++;
            }
        }
       
        return $no;
    }
    public function divC($div,$lec_no_sub)
    {
        $no = $this->getno();
        $ano = $this->getdivno('A');
        $bno = $this->getdivno('B');
        $cno = $this->getdivno('C');
        $divarray = ['A', 'B'];
        $divno=[$ano,$bno];
        $samesubjects = [];

        $i = 0;
        $last_lectures = 0;
        $o=0;
        if ($this->isgenerated($div)) // If division prev time table is exist
        {
            //find last lectures 
            

            $last_lec = DB::table('temptimetable')
                ->where('no', $cno)
                ->count('*');

            // echo "Last lectures : " . $last_lec . " -> ";
            //End last lectures

            //Generate new time for lecture
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;
            //Get no
            $no = $this->getno();

            //array store same subjects
           

            if ($last_lec < 4) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_C','!=', 0)
                    ->orderby('Remain_C', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 1)
                    ->where('Remain_C','!=', 0)
                    ->orderby('Remain_C', 'desc')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 2)
                    ->where('Remain_C','!=', 0)
                    ->orderby('Remain_C', 'desc')
                    ->take('1')
                    ->get();

                $i = 0;
                $j = 0;
          
                foreach ($subject_faculty_1 as $subject_faculty) 
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) 
                    {
                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                       // $old=$time;
                    } 
                    else 
                    {
                       // $old=$time;
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                    }

                   
                    $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();

                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                         
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 1 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                       
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                           // $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        $rec->save();
                        sleep(1);
                        $i++;
                    }
                    
                }
                foreach ($subject_faculty1 as $subject_faculty) {
                 
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    $old=$time;
                    $time = $this->gettime($time);
                    

                    }
                    $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();
                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                      
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 3 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
             
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                           // $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        if ($i > 3 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            sleep(1);
                            $i++;
                        }

                }
                foreach ($subject_faculty_2 as $subject_faculty2) 
                {
                    
                    while($j > 1)
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty2->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        $old=$time;
                        $time = $this->gettime($time);
                        
                        $exist = DB::table(table: 'temptimetable')
                        ->whereIn('division', $divarray)
                        ->whereIn('no', $divno)
                        ->where('fs_id', $subject_faculty2->id)
                        ->where('time', $time['start'])
                        ->exists();

                        if($exist)
                        {
                            if ($i == 0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                    
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 3 && $o==0) 
                            {

                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                              
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                               // $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty2->id,
                                ];
                            }
                        
                        }
                        else
                        {
                            if ($i > 3 && $o==0) 
                            {

                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                     
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                sleep(1);
                                $i++;
                            }

                        }
                        $j++;
                    }

                }
            } else if ($last_lec >= 6) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_C','!=', 0)
                    ->orderby('Remain_C', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('Remain_C','!=', 0)
                    ->where('min_lec', 2)
                    ->orderby('Remain_C', 'desc')
                    ->take('1')
                    ->get();

                    $i = 0;
                    $j = 0;
                    $o=0;
                    foreach ($subject_faculty_1 as $subject_faculty) 
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        if ($i == 0) 
                        {
                            $rec->time = $newtime['start'];
                            $rec->end_time = $newtime['end'];
                       
                          //  $old=$time;
                        } 
                        else 
                        {
                          //  $old=$time;
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        }
                        $exist = DB::table(table: 'temptimetable')
                        ->whereIn('division', $divarray)
                        ->whereIn('no', $divno)
                        ->where('fs_id', $subject_faculty->id)
                        ->where('time', $time['start'])
                        ->exists();
    
                        if($exist)
                        {
                            if ($i == 0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                            
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 1 && $o==0) 
                            {
    
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                             
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                               // $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
                           
                        }
                        else
                        {
                            $rec->save();
                            sleep(1);
                            $i++;
                        }
                        
                    }
                    foreach ($subject_faculty_2 as $subject_faculty2) 
                    {
                        
                        while($j > 1)
                        {
                            $rec = new temptimetablemodel();
                            $rec->fs_id = $subject_faculty2->id;
                            $rec->no = $no;
                            $rec->division = $div;
                            $old=$time;
                            $time = $this->gettime($time);
                            
                            $exist = DB::table(table: 'temptimetable')
                            ->whereIn('division', $divarray)
                            ->whereIn('no', $divno)
                            ->where('fs_id', $subject_faculty2->id)
                            ->where('time', $time['start'])
                            ->exists();
    
                            if($exist)
                            {
                                if ($i == 0) 
                                {
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                                   
                                    $rec->save();
                                    $i++;
                                } 
                                else if ($i > 3 && $o==0) 
                                {
    
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                  
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else
                                {
                                    $time=$old;
                                    $samesubjects[] = [
                                        'fs_id' => $subject_faculty2->id,
                                    ];
                                }
                            
                            }
                            else
                            {
                                if ($i > 3 && $o==0) 
                                {
    
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                    
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else
                                {
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                                    $rec->save();
                                    sleep(1);
                                    $i++;
                                }

                            }
    
                            $j++;
                        }
                }
            } else if ($last_lec == 4) 
            {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_C','!=', 0)
                    ->orderby('Remain_C', 'desc')
                    ->take('3')
                    ->get();

                    $i = 0;
                    $j = 0;
                    $o=0;
                    foreach ($subject_faculty_1 as $subject_faculty) 
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        if ($i == 0) 
                        {
                            $old=$time;
                            $rec->time = $newtime['start'];
                            $rec->end_time = $newtime['end'];
                           
                        } 
                        else 
                        {   $old=$time;
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                           
                        }
                        $exist = DB::table(table: 'temptimetable')
                            ->whereIn('division', $divarray)
                            ->whereIn('no', $divno)
                            ->where('fs_id', $subject_faculty->id)
                            ->where('time', $time['start'])
                            ->exists();
            
                        if($exist)
                        {
                            if ($i == 0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                          
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 1 && $o==0) 
                            {
    
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                    
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
                           
                        }
                        else
                        {
                            $rec->save();
                            sleep(1);
                            $i++;
                        }
                        
                    }     
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }else
                { $time=$old;
                }
                
                $y--;
            }

            $lengthofsamesubjects = count($samesubjects);
            $y=0;

            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }else
                { $time=$old;
                }
                
                $y++;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }else
                { $time=$old;
                }
                
                $y--;
            }
            

        } else {
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;

            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_C','!=', 0)
                ->orderBy('Remain_C', 'asc')
                ->take(3)
                ->get();

                $i = 0;
                $j = 0;
               
                foreach ($subject_faculty1 as $subject_faculty) 
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) 
                    {
                       
                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                   
                        $old=$time;
                    } 
                    else 
                    {
                        $old=$time;
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                    }
                    $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->whereIn('no', $divno)
                        ->where('fs_id', $subject_faculty->id)
                        ->where('time', $time['start'])
                        ->exists();

                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 1 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        $rec->save();
                        sleep(1);
                        $i++;
                    }
                    
                }
                $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                { $time=$old;
                }
                
                $y--;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=0;

            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();
                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                { $time=$old;
                }
                
                $y++;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                { $time=$old;
                }
                
                $y--;
            }

        }
        return $no;
    }

    public function divD($div,$lec_no_sub)
    {
        $no = $this->getno();
        $ano = $this->getdivno('A');
        $bno = $this->getdivno('B');
        $cno = $this->getdivno('C');
        $dno = $this->getdivno('D');
        $divarray = ['A', 'B','C'];
        $divno=[$ano,$bno,$cno];
        $samesubjects = [];
        
        $i = 0;
        $last_lectures = 0;
        $o=0;
        if ($this->isgenerated($div)) // If division prev time table is exist
        {
           

            $last_lec = DB::table('temptimetable')
                ->where('no', $dno)
                ->count('*');

          
            //End last lectures

            //Generate new time for lecture
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;
            //Get no
            $no = $this->getno();

            //array store same subjects
           

            if ($last_lec < 4) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_D','!=', 0)
                    ->orderby('Remain_D', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 1)
                    ->where('Remain_D','!=', 0)
                    ->orderby('Remain_D', 'desc')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('Remain_D','!=', 0)
                    ->where('min_lec', 2)
                    ->orderby('Remain_D', 'desc')
                    ->take('1')
                    ->get();

                $i = 0;
                $j = 0;
                foreach ($subject_faculty_1 as $subject_faculty) 
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) 
                    {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                            
                    } 
                    else 
                    {
                        $old=$time;
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                    }

                   
                    $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();

                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
       
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 1 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
  
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        $rec->save();
                        sleep(1);
                        $i++;
                    }
                    
                }
                foreach ($subject_faculty1 as $subject_faculty) {
                 
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    $old=$time;
                    $time = $this->gettime($time);
                    

                    }
                    $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $subject_faculty->id)
                    ->where('time', $time['start'])
                    ->exists();
                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                         
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 3 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                  
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $time=$old;
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        if ($i > 3 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                       
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            sleep(1);
                        }
                        
                        $i++;
                }
                foreach ($subject_faculty_2 as $subject_faculty2) 
                {
                    
                    while($j > 1)
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty2->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        $old=$time;
                        $time = $this->gettime($time);
                        
                        $exist = DB::table(table: 'temptimetable')
                        ->whereIn('division', $divarray)
                        ->whereIn('no', $divno)
                        ->where('fs_id', $subject_faculty2->id)
                        ->where('time', $time['start'])
                        ->exists();

                        if($exist)
                        {
                            if ($i == 0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                            
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 3 && $o==0) 
                            {

                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                  
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty2->id,
                                ];
                            }
                        
                        }
                        else
                        {
                            if ($i > 3 && $o==0) 
                            {

                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                          
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                sleep(1);
                            }
                            $i++;
                        }


                        $i++;
                        $j++;
                    }

                }
            } else if ($last_lec >= 6) {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_D','!=', 0)
                    ->orderby('Remain_D', 'desc')
                    ->take('4')
                    ->get();

                $subject_faculty_2 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('Remain_D','!=', 0)
                    ->where('min_lec', 2)
                    ->orderby('Remain_D', 'desc')
                    ->take('1')
                    ->get();

                    $i = 0;
                    $j = 0;
                 
                    foreach ($subject_faculty_1 as $subject_faculty) 
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        if ($i == 0) 
                        {
    
                            $rec->time = $newtime['start'];
                            $rec->end_time = $newtime['end'];
                            $old=$newtime;
                        } 
                        else 
                        {
                            $old=$time;
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        }
                        $exist = DB::table(table: 'temptimetable')
                        ->whereIn('division', $divarray)
                        ->whereIn('no', $divno)
                        ->where('fs_id', $subject_faculty->id)
                        ->where('time', $time['start'])
                        ->exists();
    
                        if($exist)
                        {
                            if ($i == 0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
              
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 1 && $o==0) 
                            {
    
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                             
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
                           
                        }
                        else
                        {
                            $rec->save();
                            sleep(1);
                            $i++;
                        }
                        
                    }
                    foreach ($subject_faculty_2 as $subject_faculty2) 
                    {
                        
                        while($j > 1)
                        {
                            $rec = new temptimetablemodel();
                            $rec->fs_id = $subject_faculty2->id;
                            $rec->no = $no;
                            $rec->division = $div;
                            $old=$time;
                            $time = $this->gettime($time);
                            
                            $exist = DB::table(table: 'temptimetable')
                            ->whereIn('division', $divarray)
                            ->whereIn('no', $divno)
                            ->where('fs_id', $subject_faculty2->id)
                            ->where('time', $time['start'])
                            ->exists();
    
                            if($exist)
                            {
                                if ($i == 0) 
                                {
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                              
                                    $rec->save();
                                    $i++;
                                } 
                                else if ($i > 3 && $o==0) 
                                {
    
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                              
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else
                                {
                                    $time=$old;
                                    $samesubjects[] = [
                                        'fs_id' => $subject_faculty2->id,
                                    ];
                                }
                            
                            }
                            else
                            {
                                if ($i > 3 && $o==0) 
                                {
    
                                    $time = $this->gettime($time);
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                               
                                    $rec->save();
                                    $i++;
                                    $o++;
                                } 
                                else
                                {
                                    $rec->time = $time['start'];
                                    $rec->end_time = $time['end'];
                                    $rec->save();
                                    sleep(1);
                                }
                                $i++;
                            }
    
    
                            $i++;
                            $j++;
                        }
                }
            } else if ($last_lec == 4) 
            {
                $subject_faculty_1 = DB::table('set_sub_fac_stu')
                    ->select('*')
                    ->where('deleted', 0)
                    ->where('min_lec', 1)
                    ->where('daily_lec', 0)
                    ->where('Remain_D','!=', 0)
                    ->orderby('Remain_D', 'desc')
                    ->take('3')
                    ->get();

                    $i = 0;
                    $j = 0;
                
                    foreach ($subject_faculty_1 as $subject_faculty) 
                    {
                        $rec = new temptimetablemodel();
                        $rec->fs_id = $subject_faculty->id;
                        $rec->no = $no;
                        $rec->division = $div;
                        if ($i == 0) 
                        {
    
                            $rec->time = $newtime['start'];
                            $rec->end_time = $newtime['end'];
                            $old=$newtime;
                      
                        } 
                        else 
                        {
                            $old=$time;
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        }

                        $exist = DB::table(table: 'temptimetable')
                            ->whereIn('division', $divarray)
                            ->whereIn('no', $divno)
                            ->where('fs_id', $subject_faculty->id)
                            ->where('time', $time['start'])
                            ->exists();
            
                        if($exist)
                        {
                            if ($i == 0) 
                            {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                       
                                $rec->save();
                                $i++;
                            } 
                            else if ($i > 1 && $o==0) 
                            {
    
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $i++;
                                $o++;
                            } 
                            else
                            {
                                $time=$old;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
                        }
                        else
                        {
                            $rec->save();
                            sleep(1);
                            $i++;
                        }
                    }     
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                {
                    $time=$old;
                }
                
                $y--;
            }

            $lengthofsamesubjects = count($samesubjects);
            $y=0;

            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }else
                {
                    $time=$old;
                }
                
                $y++;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                {
                    $time=$old;
                }
                
                $y--;
            }
            

        } else {
            $newtime = [];
            $time = [];
            $newtime = $this->getnewtime();
            $time = $newtime;

            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_D','!=', 0)
                ->orderBy('Remain_D', 'asc')
                ->take(3)
                ->get();

                $i = 0;
                $j = 0;
                $o=0;
                foreach ($subject_faculty1 as $subject_faculty) 
                {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $subject_faculty->id;
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 0) 
                    {

                        $rec->time = $newtime['start'];
                        $rec->end_time = $newtime['end'];
                     
                    } 
                    else 
                    {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                    }
                    $exist = DB::table(table: 'temptimetable')
                        ->where('division', 'A')
                        ->whereIn('no', $divno)
                        ->where('fs_id', $subject_faculty->id)
                        ->where('time', $time['start'])
                        ->exists();

                    if($exist)
                    {
                        if ($i == 0) 
                        {
                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                        
                            $rec->save();
                            $i++;
                        } 
                        else if ($i > 1 && $o==0) 
                        {

                            $time = $this->gettime($time);
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                           
                            $rec->save();
                            $i++;
                            $o++;
                        } 
                        else
                        {
                            $samesubjects[] = [
                                'fs_id' => $subject_faculty->id,
                            ];
                        }
                       
                    }
                    else
                    {
                        $rec->save();
                        sleep(1);
                        $i++;
                    }
                    
                }
                $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                {
                    $time=$old;
                }
                
                $y--;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=0;

            while($y < $lengthofsamesubjects)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();
                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }else
                {
                    $time=$old;
                }
                
                $y++;
            }
            $lengthofsamesubjects = count($samesubjects);
            $y=$lengthofsamesubjects;
            while($y < 0)
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $samesubjects[$y]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                $old=$time;
                $time = $this->gettime($time);
                $rec->time = $time['start'];
                $rec->end_time = $time['end'];

                $exist = DB::table(table: 'temptimetable')
                    ->whereIn('division', $divarray)
                    ->whereIn('no', $divno)
                    ->where('fs_id', $samesubjects[$y]['fs_id'])
                    ->where('time', $time['start'])
                    ->exists();

                if(!$exist)
                {
                    $rec->save();
                    unset($samesubjects[$y]);
                }
                else
                {
                    $time=$old;
                }
                $y--;
            }

        }

        return $no;
    }

    function downloadttm(Request $rec)
    {
        $nextDay = $rec->date;

         if($rec->ano != -1)
         {
            $ano = $rec->ano;
            $arrayno = [$ano];
         }
         if($rec->bno != -1)
         {
            $bno = $rec->bno;
            $arrayno = [$ano,$bno];
         }
        if($rec->cno != -1)
         {
            $cno = $rec->cno;
            $arrayno = [$ano,$bno,$cno];
         }
         if($rec->dno != -1)
         {
            $dno1 = $rec->dno;
            $arrayno = [$ano,$bno,$cno,$dno1];
         }
  
        $ttm1 = DB::table('temptimetable as t1')
        ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
        ->whereIn('t1.no', $arrayno)
        ->get();

        $dataArray1 = [];

        foreach($ttm1 as $t1){
           if($t1->division == 'A')
           {
            $dataArray1[] = [
                'fs_id' => $t1->fs_id,
                'division' => $t1->division ,
                'no' => $t1->no, 
                'remain' => $t1->Remain_A,
                ];
           }
           else if($t1->division == 'B')
           {
            $dataArray1[] = [
                'fs_id' => $t1->fs_id,
                'division' => $t1->division ,
                'no' => $t1->no, 
                'remain' => $t1->Remain_B,
                ];
           }
           else if($t1->division == 'C')
           {
            $dataArray1[] = [
                'fs_id' => $t1->fs_id,
                'division' => $t1->division ,
                'no' => $t1->no, 
                'remain' => $t1->Remain_C,
                ];
           }
           else if($t1->division == 'D')
           {
            $dataArray1[] = [
                'fs_id' => $t1->fs_id,
                'division' => $t1->division ,
                'no' => $t1->no, 
                'remain' => $t1->Remain_D,
                ];
           }
        }

        $lengthArray = count($dataArray1);

        $k=0;

        while($k < $lengthArray)
        {
            if($dataArray1[$k]['division'] == 'A')
            {
                DB::table('set_sub_fac_stu')
                ->where('id', $dataArray1[$k]['fs_id'])
                ->update(['Remain_A' => $dataArray1[$k]['remain'] - 1 ] );
            }
            else  if($dataArray1[$k]['division'] == 'B')
            {
                DB::table('set_sub_fac_stu')
                ->where('id', $dataArray1[$k]['fs_id'])
                ->update(['Remain_B' => $dataArray1[$k]['remain'] - 1 ] );
            }
            else  if($dataArray1[$k]['division'] == 'C')
            {
                DB::table('set_sub_fac_stu')
                ->where('id', $dataArray1[$k]['fs_id'])
                ->update(['Remain_C' => $dataArray1[$k]['remain'] - 1 ] );
            }
            else  if($dataArray1[$k]['division'] == 'D')
            {
                DB::table('set_sub_fac_stu')
                    ->where('id', $dataArray1[$k]['fs_id'])
                    ->update(['Remain_D' => $dataArray1[$k]['remain'] - 1 ] );
            }
        $k++;
        }

        $filename = 'ttm_' . $nextDay . '.pdf';
      
        $pdf = PDF::loadview('admin/download_timetable', compact('ano','bno','cno','dno1','nextDay'));
   
        return $pdf->stream('ttm_' . $nextDay . '.pdf');
    }
}

