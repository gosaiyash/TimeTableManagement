<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>College Timetable</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      margin: 20px;
    }
    .timetable {
      width: 100%;
      border-collapse: collapse;
    }
    .timetable th, .timetable td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
      vertical-align: middle;
    }
    .timetable th {
      background-color: #f2f2f2;
    }
    .header-title {
      text-align: center;
      font-size: 18px;
      font-weight: bold;
    }
    .sub-header {
      text-align: center;
      font-weight: bold;
    }
    .display-date {
      margin-top: 10px;
      font-size: 14px;
      text-align: right;
    }
    
    /* Button Styles */
    .button-container {
      display: flex;
      gap: 10px;
      margin: 20px 0;
      align-items: center;
    }
    
    .btn {
      padding: 8px 16px;
      border-radius: 4px;
      font-weight: 500;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }
    
    .btn-danger {
      background: #e74a3b;
      color: white;
    }
    
    .btn-primary {
      background: #4e73df;
      color: white;
    }
    
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Form Controls */
    .form-group {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    input[type="date"] {
      padding: 6px 12px;
      border: 1px solid #d1d3e2;
      border-radius: 4px;
      font-size: 14px;
    }
    
    label {
      font-weight: 500;
      color: #4a5568;
    }
  </style>
</head>
<body>
  <div class="header-title">LOK JAGRUTI KENDRA UNIVERSITY<br>
    INTEGRATED MASTERS OF SCIENCE (INFORMATION TECHNOLOGY)<br>
    Time Table Management System</div>

  <div class="sub-header">( {{ $nextDay->format( 'l j - F - Y') }})</div>
      
    @php

    $counter = 1;
    $minutuse5 = sprintf('%02d:%02d', 0, 05);
    $i=0;
    $j=0;
   
    $times = [
    sprintf('%02d:%02d', 8, 0),
    sprintf('%02d:%02d', 8, 55),
    sprintf('%02d:%02d', 9, 50),
    sprintf('%02d:%02d', 10, 45),
    sprintf('%02d:%02d', 11, 45),
    sprintf('%02d:%02d', 12, 00),
    sprintf('%02d:%02d', 12, 45),
    sprintf('%02d:%02d', 13, 50),
    sprintf('%02d:%02d', 14, 45),
    sprintf('%02d:%02d', 15, 40),
    sprintf('%02d:%02d', 16, 35),
    sprintf('%02d:%02d', 17, 30),
];


$c_no =$cno;
$b_no =$bno;
$a_no =$ano;
$d_no=$dno1;
$a=0;
$b=0;
$c=0;
$d=0;

if($a_no != -1)
{
  $ttm1 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $a_no)
            ->get();

          $dataArray1 = [];
          foreach($ttm1 as $t1){

              $dataArray1[] = [
                  'time' => $t1->time,
                  'end' => $t1->end_time,
                  'subject' => $t1->subject_name ,
                  'room' => $t1->class_type . ' ' . $t1->roomno,
                  'faculty' => $t1->faculty_name,
              ];
              $a++;
            }
}

if($b_no != -1)
{
  $ttm2 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $b_no)
            ->get();

  $dataArray2 = [];
  foreach($ttm2 as $t2){

    $dataArray2[] = [
        'time' => $t2->time,
        'end' => $t2->end_time,
        'subject' => $t2->subject_name ,
        'room' => $t2->class_type . ' ' . $t2->roomno,
        'faculty' => $t2->faculty_name,
    ];
    $b++;
    }
}

if($c_no != -1)
{
  $ttm3 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $c_no)
            ->get();

    $dataArray3 = [];
    foreach($ttm3 as $t3){

    $dataArray3[] = [
        'time' => $t3->time,
        'end' => $t3->end_time,
        'subject' => $t3->subject_name ,
        'room' => $t3->class_type . ' ' . $t3->roomno,
        'faculty' => $t3->faculty_name,
    ];
    $c++;
    }

}

if($d_no != -1)
{
    $ttm4 = DB::table('temptimetable as t1')
            ->join('set_sub_fac_stu as sfs', 'sfs.id', '=', 't1.fs_id')
            ->join('add_faculty_models as f', 'sfs.faculty_id', '=', 'f.f_id')
            ->join('subject_models as s', 'sfs.subject_id', '=', 's.id')
            ->where('t1.no', $d_no)
            ->get();

  $dataArray4 = [];
  foreach($ttm4 as $t4){

      $dataArray4[] = [
          'time' => $t4->time,
          'end' => $t4->end_time,
          'subject' => $t4->subject_name ,
          'room' => $t4->class_type . ' ' . $t4->roomno,
          'faculty' => $t4->faculty_name,
      ];

      $d++;
  }
}

@endphp
              
    
@php
  $allEntries = [];

  foreach ($dataArray1 ?? [] as $entry) {
      $key = $entry['time'] . ' To ' . $entry['end'];
      $allEntries[$key]['A'][] = "{$entry['subject']}<br>{$entry['room']}<br>{$entry['faculty']}";
  }

  foreach ($dataArray2 ?? [] as $entry) {
      $key = $entry['time'] . ' To ' . $entry['end'];
      $allEntries[$key]['B'][] = "{$entry['subject']}<br>{$entry['room']}<br>{$entry['faculty']}";
  }

  foreach ($dataArray3 ?? [] as $entry) {
      $key = $entry['time'] . ' To ' . $entry['end'];
      $allEntries[$key]['C'][] = "{$entry['subject']}<br>{$entry['room']}<br>{$entry['faculty']}";
  }

  foreach ($dataArray4 ?? [] as $entry) {
      $key = $entry['time'] . ' To ' . $entry['end'];
      $allEntries[$key]['D'][] = "{$entry['subject']}<br>{$entry['room']}<br>{$entry['faculty']}";
  }

  // Sort time slots
  ksort($allEntries);
@endphp

<table class="timetable">
  <tr>
    <th colspan="6">Semester - 4</th>
  </tr>
  <tr>
    <th>Lect No.</th>
    <th>Time Slot</th>
    <th>A</th>
    <th>B</th>
    <th>C</th>
    <th>D</th>
  </tr>

  @php $index = 1; @endphp
@foreach($allEntries as $timeSlot => $columns)
  <tr>
    <td>{{ $index++ }}</td>
    <td>{{ $timeSlot }}</td>
    <td>{!! isset($columns['A']) ? implode('<hr>', $columns['A']) : '' !!}</td>
    <td>{!! isset($columns['B']) ? implode('<hr>', $columns['B']) : '' !!}</td>
    <td>{!! isset($columns['C']) ? implode('<hr>', $columns['C']) : '' !!}</td>
    <td>{!! isset($columns['D']) ? implode('<hr>', $columns['D']) : '' !!}</td>
  </tr>
@endforeach

</table>

  <form method="get" action=" {{ url('/pdfttm') }}">
    <div class="button-container">
      <div class="form-group">
        <label for="date">Change Date:</label>
        <input 
            type="date" 
            id="date" 
            name="date" 
            value="{{ $nextDay->format('Y-m-d') }}" 
            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
            required
        >
        <input type="hidden" id="ano" name="ano" value="{{  $a_no }}">
        <input type="hidden" id="bno" name="bno" value="{{  $b_no }}">
        <input type="hidden" id="cno" name="cno" value="{{  $c_no }}">
        <input type="hidden" id="dno" name="dno" value="{{  $d_no }}">
      </div>
      
      <button type="submit" class="btn btn-danger">
        <i class="fas fa-check"></i> Confirm Time Table
      </button>
      
      <button type="button" class="btn btn-primary" onclick="window.location.reload()">
        <i class="fas fa-sync-alt"></i> Regenerate
      </button>
    </div>
  </form>
 

</body>
</html>

<style>
    form {
        max-width: 400px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }

    input[type="date"] {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    .btn-danger {
        display: inline-block;
        background-color: #dc3545;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>
