<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use App\Models\temptimetablemodel;
use Illuminate\Http\Request;

class ttm_generate_controller extends Controller
{
    //Generate new time function start 
    public function newtime()
    {
        $newstarttime = random_int(8, 11);
        $newtime = $newstarttime;
        if ($newtime == 8) {
            $hours2 = $newtime;
            $minutes2 = 05;
        } else if ($newtime == 9) {
            $hours2 = $newtime;
            $minutes2 = 00;
        } else if ($newtime == 10) {
            $hours2 = 10;
            $minutes2 = 50;
        } else if ($newtime == 11) {
            $hours2 = 11;
            $minutes2 = 45;
        }

        $totalMinutes = ($hours2 * 60 + $minutes2);
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        [$hours, $minutes1] = explode(':', $result);
        $hours2 = $hours;
        $minutes2 = $minutes1 + 50;
        $totalMinutes = ($hours2 * 60 + $minutes2);
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);

        $time = [
            'start' => $result,
            'end' => $result1,
        ];

        return $time;
    }
    //new time function end

    //generate next time
    public function gettime($oldtime)
    {
        $h = $oldtime['end'];
        [$hours, $minutes1] = explode(':', $h);
        $hours2 = $hours;
        $minutes2 = $minutes1 + 05;
        $totalMinutes = ($hours2 * 60 + $minutes2);
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        //End time
        [$hours, $minutes1] = explode(':', $result);
        $hours2 = $hours;
        $minutes2 = $minutes1 + 50;
        $totalMinutes = ($hours2 * 60 + $minutes2);
        $finalHours = floor($totalMinutes / 60);
        $finalMinutes = $totalMinutes % 60;
        $result1 = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        $time = [
            'start' => $result,
            'end' => $result1,
        ];
        return $time;
    }
    //next time function end

    //get division last no
    public function getdivno($div)
    {
        $no = 0;
        $oldno = DB::table('temptimetable')
            ->select('id', 'no')
            ->where('division', $div)
            ->latest('no')
            ->take(1)
            ->get();

        foreach ($oldno as $no1) {
            $no = $no1->no;
        }

        return $no;
    }
    //end division last no function

    //generate new no for division
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
    //end new no functioon

    //Find division first time or not
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
    //end isgenerated function

    //generate time table function start
    public function generatetimetable()
    {
        $ano = -1;$bno = -1;$cno = -1;$dno1 = -1;
        $letters = range('A', 'Z'); //name of divisoins
        $n = 0;
        $notzero = DB::table('set_sub_fac_stu')
        ->where('Remain_A', '>', 0)
        ->exists();

        if($this->isgenerated($letters[0]))
        {
            if($notzero) 
            {
                $a = random_int(3, 6);
                $no = $this->getno();
                $this->regulartimediv($letters[0], $no, -1, -1, -1, $a);
                sleep(1);
                $ano=$no;
            } 
            else 
            {
                $ano = -1;
            }
        }
        else
        {
            
            $no = $this->getno();
            $this->firsttimediv($letters[0], $no, -1, -1, -1, 3);
            sleep(1);
            $ano=$no;
        }

        if($this->isgenerated($letters[1]))
        {
            $notzero = DB::table('set_sub_fac_stu')
            ->where('Remain_B', '>', 0)
            ->exists();
            if($notzero) 
            {
                $b = random_int(3, 6);
                $no = $this->getno();
                $this->regulartimediv($letters[01], $no, $ano, -1, -1, $b);
                sleep(1);
                $bno=$no;
            } 
            else 
            {
                $bno = -1;
            }
        }
        else
        {
            $no = $this->getno();
            $this->regulartimediv($letters[01], $no, $ano, -1, -1, 3);
            sleep(1);
            $bno=$no;
        }

        if($this->isgenerated($letters[2]))
        {
            $notzero = DB::table('set_sub_fac_stu')
            ->where('Remain_B', '>', 0)
            ->exists();
            if($notzero) 
            {
                $b = random_int(3, 6);
                $no = $this->getno();
                $this->regulartimediv($letters[02], $no, $ano, -1, -1, $b);
                sleep(1);
                $cno=$no;
            } 
            else 
            {
                $cno = -1;
            }
        }
        else
        {
                $no = $this->getno();
                $this->regulartimediv($letters[02], $no, $ano, -1, -1, 3);
                sleep(1);
                $cno=$no;
        }

        if($this->isgenerated($letters[3]))
        {
            $$notzero = DB::table('set_sub_fac_stu')
            ->where('Remain_D', '>', 0)
            ->exists();
            if($notzero) 
            {
                $d = random_int(3, 6);
                $no = $this->getno();
                $this->regulartimediv($letters[3], $no, $ano, $bno, $cno, $d);
                sleep(1);
                $dno1 = $no;
            } 
            else 
            {
                $dno1 = -1;
            }
        }
        else
        {  
                $no = $this->getno();
                $this->regulartimediv($letters[3], $no, $ano, $bno, $cno, 3);
                sleep(1);
                $dno1 = $no;
        }

        sleep(1);

        $nextDay = Carbon::now()->addDay();

        if ($nextDay->isSunday()) {
            $nextDay = $nextDay->addDay(); // Go to Monday
        }

        return view('admin/view_timetable', compact('ano','bno','cno','dno1','nextDay'));
        
    }
    //end generate time table function

    //start generate first time for this division
    public function firsttimediv($div, $no, $ano, $bno, $cno, $ui)
    {
        $i = 1;
        $j = 0;
        $thisdiv = 0;
        $o = 0;
        $time = [];
        $samesubjects = [];
        if ($div == 'A') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_A', '!=', 0)
                ->orderBy('Remain_A', 'asc')
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_A', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        } else if ($div == 'B') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_B', '!=', 0)
                ->orderBy('Remain_B', 'asc')
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_B', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        } else if ($div == 'C') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_C', '!=', 0)
                ->orderBy('Remain_C', 'asc')
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_C', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        } else if ($div == 'D') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->join('add_faculty_models', 'set_sub_fac_stu.faculty_id', '=', 'add_faculty_models.f_id')
                ->join('subject_models', 'set_sub_fac_stu.subject_id', '=', 'subject_models.id')
                ->select('*')
                ->where('daily_lec', 0)
                ->where('min_lec', 1)
                ->where('Remain_D', '!=', 0)
                ->orderBy('Remain_D', 'asc')
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_D', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        }

        while ($thisdiv < $ui) {
            foreach ($subject_faculty1 as $subject_faculty) {
                $rec = new temptimetablemodel();
                $rec->fs_id = $subject_faculty->id;
                $rec->no = $no;
                $rec->division = $div;
                if ($i == 1 && $thisdiv != 0) {
                    $time = $this->gettime($time);
                } else if ($thisdiv == 0) {
                    $time = $this->newtime();
                }

                if($div != 'A')
                {
                    $arraydiv = [$ano,$bno,$cno];

                        $exist = DB::table(table: 'temptimetable')
                            ->whereIn('no', $arraydiv)
                            ->where('fs_id', $subject_faculty->id)
                            ->where('time', $time['start'])
                            ->exists();
    
                        if ($exist) {
                            if ($thisdiv == 0) {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                            } else if ($thisdiv > 1 && $o == 0) {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $o++;
                            } else {
                                $i == 0;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
    
                        } else {
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            sleep(1);
    
                        }                   
    
                }
                else
                {
                    $rec->time = $time['start'];
                    $rec->end_time = $time['end'];
                    $rec->save();
                    sleep(1); 
                }
              

                $length = count($samesubjects);

                while ($length > $j) {
                    $rec = new temptimetablemodel();
                    $rec->fs_id = $samesubjects[$j]['fs_id'];
                    $rec->no = $no;
                    $rec->division = $div;
                    if ($i == 1 && $thisdiv != 0) {
                        $time = $this->gettime($time);
                    } else if ($thisdiv == 0) {
                        $time = $this->newtime();
                    }

                    if($div != 'A')
                {
                    $arraydiv = [$ano,$bno,$cno];

                        $exist = DB::table(table: 'temptimetable')
                            ->whereIn('no', $arraydiv)
                            ->where('fs_id', $subject_faculty->id)
                            ->where('time', $time['start'])
                            ->exists();
    
                        if ($exist) {
                            if ($thisdiv == 0){
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                            } else if ($thisdiv > 1 && $o == 0) {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                $o++;
                            } else {
                                $i == 0;
                                $samesubjects[] = [
                                    'fs_id' => $subject_faculty->id,
                                ];
                            }
    
                        } else {
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            sleep(1);
    
                        }                   
    
                }
                else
                {
                    $rec->time = $time['start'];
                    $rec->end_time = $time['end'];
                    $rec->save();
                    sleep(1); 
                }
                  

                    $j++;
                    $thisdiv++;
                }
                $thisdiv++;
            }
        }
    }
    //end first time function

    //start generate regular time for this division
    public function regulartimediv($div, $no, $ano, $bno, $cno, $ui)
    {
        $i = 1;
        $j = 0;
        $thisdiv = 0;
        $o = 0;
        $time = [];
        $samesubjects = [];
        $take1 = 0;
        $take2 = 0;
        $take3 = 0;
        $subject = [];
        $subject1 = [];

        if ($ui == 3) {
            $take1 = 2;
            $take2 = 1;
            $take3 = 0;
        } else if ($ui == 4) {
            $take1 = 2;
            $take2 = 2;
            $take3 = 0;
        } else if ($ui == 5) {
            $take1 = 2;
            $take2 = 2;
            $take3 = 1;
        } else if ($ui == 6) {
            $take1 = 3;
            $take2 = 2;
            $take3 = 1;
        } else if ($ui == 8) {
            $take1 = 3;
            $take2 = 3;
            $take3 = 1;
        } else {
            $take1 = 1;
            $take2 = 3;
            $take3 = 0;
        }

        if ($div == 'A') {

            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 0)
                ->where('Remain_A', '!=', 0)
                ->orderby('Remain_A', 'desc')
                ->take($take1)
                ->get();

            $subject_faculty2 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 1)
                ->where('Remain_A', '!=', 0)
                ->orderby('Remain_A', 'desc')
                ->take($take2)
                ->get();

            $subject_faculty3 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->orderby('Remain_A', 'desc')
                ->where('Remain_A', '!=', 0)
                ->where('min_lec', 2)
                ->take($take3)
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_A', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        } else if ($div == 'B') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 0)
                ->where('Remain_B', '!=', 0)
                ->orderby('Remain_B', 'desc')
                ->take($take1)
                ->get();

            $subject_faculty2 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 1)
                ->where('Remain_B', '!=', 0)
                ->orderby('Remain_B', 'desc')
                ->take($take2)
                ->get();

            $subject_faculty3 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->orderby('Remain_B', 'desc')
                ->where('Remain_B', '!=', 0)
                ->where('min_lec', 2)
                ->take($take3)
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_B', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        } else if ($div == 'C') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 0)
                ->where('Remain_C', '!=', 0)
                ->orderby('Remain_C', 'desc')
                ->take($take1)
                ->get();

            $subject_faculty2 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 1)
                ->where('Remain_C', '!=', 0)
                ->orderby('Remain_C', 'desc')
                ->take($take2)
                ->get();

            $subject_faculty3 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->orderby('Remain_C', 'desc')
                ->where('Remain_C', '!=', 0)
                ->where('min_lec', 2)
                ->take($take3)
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_C', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        } else if ($div == 'D') {
            $subject_faculty1 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 0)
                ->where('Remain_D', '!=', 0)
                ->orderby('Remain_D', 'desc')
                ->take($take1)
                ->get();

            $subject_faculty2 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->where('min_lec', 1)
                ->where('daily_lec', 1)
                ->where('Remain_D', '!=', 0)
                ->orderby('Remain_D', 'desc')
                ->take($take2)
                ->get();

            $subject_faculty3 = DB::table('set_sub_fac_stu')
                ->select('*')
                ->where('deleted', 0)
                ->orderby('Remain_D', 'desc')
                ->where('Remain_D', '!=', 0)
                ->where('min_lec', 2)
                ->take($take3)
                ->get();

            $notzero = DB::table('set_sub_fac_stu')
                ->where('Remain_D', '>', 0)
                ->exists();
            if (!$notzero) {
                echo "No lectures found";
            }
        }

        $y = 0;
        foreach ($subject_faculty1 as $subject_faculty) {
            $subject[$y] = [
                'fs_id' => $subject_faculty->id,
            ];
            $y++;
        }
        foreach ($subject_faculty2 as $subject_faculty) {
            $subject[$y] = [
                'fs_id' => $subject_faculty->id,
            ];
            $y++;
        }
        foreach ($subject_faculty3 as $subject_faculty) {
            $subject[$y] = [
                'fs_id' => $subject_faculty->id,
            ];
            $y++;
        }

        $this->setsubjects($subject,$div,$no, $ano, $bno, $cno);

    }
    //end regular time function

    //setsubjects start
    public function setsubjects($subject,$div, $no, $ano, $bno, $cno)
    {
        $j = 0;
        $thisdiv = 0;
        $o = 0;
        $i = 1;
        $length = count($subject);
        $setno =1;
        if($length > 3 && $length < 6)
        {
            $setno = 2;
        }
        else if($length > 3 && $length < 7)
        {
            $setno = 3;
        }
        else if($length > 3 && $length < 9)
        {
            $setno = 4;
        }
            while ($length > $j) 
            {
                $rec = new temptimetablemodel();
                $rec->fs_id = $subject[$j]['fs_id'];
                $rec->no = $no;
                $rec->division = $div;
                if ($i == 1 && $thisdiv != 0) {
                    $time = $this->gettime($time);
                } else if ($thisdiv == 0) {
                    $time = $this->newtime();
                }

                if($div != 'A')
                { 
                    $arraydiv = [$ano,$bno,$cno];

                        $exist = DB::table(table: 'temptimetable')
                            ->whereIn('no', $arraydiv)
                            ->where('fs_id', $subject[$j]['fs_id'])
                            ->where('time', $time['start'])
                            ->exists();
    
                        if ($exist) 
                        {
                            if ($thisdiv == 0 && $o==0) {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                unset($subject[$j]);
                                $o++;
                            } else if ($thisdiv > 1 && $o == 0) {
                                $time = $this->gettime($time);
                                $rec->time = $time['start'];
                                $rec->end_time = $time['end'];
                                $rec->save();
                                unset($subject[$j]);
                                $o++;
                            }
                        }
                        else 
                        {
                            $rec->time = $time['start'];
                            $rec->end_time = $time['end'];
                            $rec->save();
                            unset($subject[$j]);
                        }   
                }
                else 
                {
                    if($thisdiv == $setno && $o==0)
                    {
                        $time = $this->gettime($time);
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                        $rec->save();
                        unset($subject[$j]);
                    }
                    else
                    {
                        $rec->time = $time['start'];
                        $rec->end_time = $time['end'];
                        $rec->save();
                        unset($subject[$j]);
                    }
                }
                
                $j++;
                $thisdiv++;
            }
    }
    //end setsubjects function

    //download time table 
    function downloadttm(Request $rec)
    {
        $nextDay = $rec->date;
        $ano = $rec->ano;
        $bno = $rec->bno;
        $cno = $rec->cno;
        $dno1 = $rec->dno;
        $arrayno = [$ano,$bno,$cno,$dno1];
        
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
    //end download time table
}
