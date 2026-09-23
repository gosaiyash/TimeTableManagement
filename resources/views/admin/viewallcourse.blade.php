<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
</head>
<body>
<div class="main">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="back">
        <a href="/viewdata" class="btn btn-info btn-sm">Back</a>
        </div>
      </div>
      <!-- Faculty -->
    <div class="formdiv">
    <div>
         @if(Session::has('update'))
        <div class="alert alert-success" id="session2">
            {{ Session::get('update') }}
        </div>
        @endif
    </div>

    <h1 class="h1tag">Faculty & Subject</h1>

    <div class="tableclass">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Subject ID</th>
                        <th>Faculty ID</th>
                        <th>Subject Name</th>
                        <th>Faculty Name</th>
                        <th>Sem</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($data as $r)

                    <tr>
                        <td>{{ $r->subject_id }}</td>
                        <td>{{ $r->f_id }}</td>
                        <td>{{ $r->subject_name }}</td>
                        <td>{{ $r->faculty_name }}</td>
                        <td>4</td>
                    </tr>

                    @endforeach
                
                </tbody>
            </table>
    
      </div>
      </div>
      </div>
      


</body>
</html>

<style>
    
     .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table thead th {
            position: sticky;
            top: 0;
            background-color: #343a40;
            color: white;
            z-index: 1;
           
        }
        .table-fixed-header {
            overflow-y: auto;
            height: 500px;
        }
        .tableclass
        {
          width:76vw;
          margin-left:282px;
        }
        .back{
          padding-left:90px;
          width:15vw;
          
        }
        tr,th,td,table{
            border:1px solid black;
            
        }
        .h1tag
        {
            margin-left:520px;
        }
</style>