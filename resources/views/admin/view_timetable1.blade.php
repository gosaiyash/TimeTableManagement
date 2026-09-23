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
  </style>
</head>
<body>
  <div class="header-title">LOK JAGRUTI KENDRA UNIVERSITY<br>
    INTEGRATED MASTERS OF SCIENCE (INFORMATION TECHNOLOGY)<br>
    Time Table Management System</div>

  <div class="sub-header">( {{ $nextDay->format( 'l j - F - Y') }})</div>
  
  <table class="timetable">
    <tr>
      
      
      <th colspan="11">Semester - 4</th>
    </tr>

    <tr>
        <th>Lect No.</th>
         <th>Time</th>
        <th>A</th>
        <th>Time</th>
        <th>B</th>
        <th>Time</th>
        <th>c</th>
        <th>Time</th>
        <th>d</th>
       
    </tr>
    </tr>
    
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

$a1=0;
$a2=0;
$a3=0;
$a4=0;

$dataArray1 = [];
foreach($ttm1 as $t1){

    $dataArray1[] = [
        'time' => $t1->time,
        'subject' => $t1->subject_name ,
        'room' => $t1->class_type . ' ' . $t1->roomno,
        'faculty' => $t1->faculty_name,
    ];

  $a1++;
}


    $dataArray2 = [];
    foreach($ttm2 as $t2){
    $dataArray2[] = [

        'time' => $t2->time,
        'subject' => $t2->subject_name ,
        'room' => $t2->class_type . ' ' . $t2->roomno,
        'faculty' => $t2->faculty_name,
    ];

  $a2++;
}

    $dataArray3= [];

    foreach($ttm3 as $t3){
    $dataArray3[] = [
        'time' => $t3->time,
        'subject' => $t3->subject_name ,
        'room' => $t3->class_type . ' ' . $t3->roomno,
        'faculty' => $t3->faculty_name,
    ];

    $a3++;
}
$dataArray4= [];

foreach($ttm4 as $t){
    $dataArray4[] = [
        'time' => $t->time,
        'subject' => $t->subject_name ,
        'room' => $t->class_type . ' ' . $t->roomno,
        'faculty' => $t->faculty_name,
 ];

 $a4++;
}
@endphp
              
    

    
<tr>
      
     @while($i != 8)
           
    <tr>
      <td> {{ $counter }} </td>
      
        @if(!empty($dataArray1)  && $i < $a1)

        <td>{{  $dataArray1[$i]['time'] }}</td>
        <td>{{ $dataArray1[$i]['subject'] }} <br> {{ $dataArray1[$i]['room'] }} <br>{{ $dataArray1[$i]['faculty'] }}</td>
      
        @endif

        @if(!empty($dataArray2) && $i < $a2)
        <td>{{  $dataArray2[$i]['time'] }}</td>
        <td>{{ $dataArray2[$i]['subject'] }} <br> {{ $dataArray2[$i]['room'] }} <br>{{ $dataArray2[$i]['faculty'] }}</td>
        @endif

        @if(!empty($dataArray3) && $i < $a3)
        <td>{{  $dataArray3[$i]['time'] }}</td>
        <td>{{ $dataArray3[$i]['subject'] }} <br> {{ $dataArray3[$i]['room'] }} <br>{{ $dataArray3[$i]['faculty'] }}</td>
       @endif

        @if(!empty($dataArray4) && $i < $a4)
        <td>{{  $dataArray4[$i]['time'] }}</td>
        <td>{{ $dataArray4[$i]['subject'] }} <br> {{ $dataArray4[$i]['room'] }} <br>{{ $dataArray4[$i]['faculty'] }}</td>
       @endif

       
      @php
        $counter++;
        $i++;
      @endphp
    
    </tr>
    @endwhile
         
    </table>

  <br><br>
  <button class="btn-danger"><a href="/pdfttm">Download</a></button>

</body>
</html>
