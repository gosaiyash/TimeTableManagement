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
      <th rowspan="2">Lect No.</th>
      <th rowspan="2">Time</th>
      <th colspan="5">Semester - 4</th>
    </tr>

    <tr>
        <th>A</th>
        <th>B</th>
        <th>c</th>
        <th>d</th>
    </tr>
    
    @php
    $counter = 1;
    $minutuse5 = sprintf('%02d:%02d', 0, 05);
    @endphp

    @foreach($ttm as $rec)
          
    </tr>

    <tr>

      <td> {{ $counter }} </td><td> {{ $rec->time . ' To ' . $rec->end_time }}</td>
     
      <td>{{ $rec->subject_name }} <br> {{ $rec->class_type .' ' . $rec->roomno }} <br>{{ $rec->faculty_name }}</td>
      
      <td>{{ $rec->subject_name }} <br> {{ $rec->class_type .' ' . $rec->roomno }} <br>{{ $rec->faculty_name }}</td>
  
      <td>{{ $rec->subject_name }} <br> {{ $rec->class_type .' ' . $rec->roomno }} <br>{{ $rec->faculty_name }}</td>
  
      <td>{{ $rec->subject_name }} <br> {{ $rec->class_type .' ' . $rec->roomno }} <br>{{ $rec->faculty_name }}</td>
  
    </tr>

    @php
        $counter++;
    @endphp

    @endforeach

  </table>

</body>
</html>
