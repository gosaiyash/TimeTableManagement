<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Time Table Management</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
   
  </head>
  <body>
    <div class="main">
      <!-- Sidebar -->
    <div   class="sidebar" data-background-color="dark">
        
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
               

            @if(Session::has('admin_id'))
              
             <div class="namediv">
                <div>
                  <img src="{{ Session::get('admin_image') }}" alt="Image">
                
                </div>
                <div>
                
                 <h2 class="adname"> {{ Session::get('admin_name') }} </h2>
                </div>

             </div>
            
            @else

            

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="/admin_r">
                  <i class="fas fa-pen-square"></i>
                  <p>Add Admins</p>
                  <span class="caret"></span>
                </a>
              </li>

             @endif
              
             <hr>

             <li class="nav-item">
                <a data-bs-toggle="collapse" href="/upload_ttm">
                  <i class="fas fa-pen-square"></i>
                  <p>Upload Time Table</p>
                  <span class="caret"></span>
                </a>
              </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="/addforms">
                  <i class="fas fa-pen-square"></i>
                  <p>Forms</p>
                  <span class="caret"></span>
                </a>
              </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="/viewdata">
                  <i class="fas fa-table"></i>
                  <p>View data</p>
                  <span class="caret"></span>
                </a>
              </li>

              <li class="nav-item">
                <a href="/sortsubject">
                  <i class="fas fa-file"></i>
                  <p>Generate Time Table</p>
                  <span class="badge badge-secondary"></span>
                </a>
              </li>

              <li class="nav-item">
                <a href="/datadownload">
                  <i class="fas fa-desktop"></i>
                  <p>Download data</p>
                  <span class="badge badge-success">1</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/openmail">
                  <i class="fas fa-file"></i>
                  <p>Send Mail</p>
                  <span class="badge badge-success">1</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="/reportlist">
                  <i class="fas fa-desktop"></i>
                  <p>Reports</p>
                  <span class="badge badge-success">1</span>
                </a>
              </li>
              

                </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="formdiv">
      @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
      <div class="form-group">

  <div class="card-container">
  @foreach ($documents as $doc)
    <div class="pdf-card">
      <div class="pdf-header">📅 Date: {{ $doc->date }}</div>
      <div class="pdf-meta">Semester {{ $doc->sem }}</div>
      <div class="pdf-description">{{ $doc->description }}</div>

      <iframe class="pdf-preview" src="{{ $doc->path }}#toolbar=0&navpanes=0" type="application/pdf"></iframe>

      <a href="{{ route('update_ttm', ['id' => $doc->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
      <a href="{{ route('delete_ttm', ['id' => $doc->id]) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>

    </div>
  @endforeach
</div>

  
</body>
</html>

<style>

.adname
{
  margin-left:18px;
  margin-top:21px;
}
img
{
  width:80px;
  height:83px;
  border-radius:60px;
  margin-left:10px;
}
.namediv
{
  display:flex;
}
* {
      box-sizing: border-box;
      font-family: 'Public Sans', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background: linear-gradient(to right, #f1f4f9, #dff1ff);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .upload-form-container {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    .upload-form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      font-size: 15px;
      color: #34495e;
      display: block;
      margin-bottom: 8px;
    }

    input[type="file"],
    select,
    input[type="date"],
    textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    input[type="file"]:focus,
    select:focus,
    input[type="date"]:focus,
    textarea:focus {
      border-color: #1e88e5;
      outline: none;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(to right, #1e88e5, #5e35b1);
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
    }

    .submit-btn:hover {
      background: linear-gradient(to right, #ffee58, #66bb6a);
      transform: translateY(-2px);
    }

    .submit-btn:active {
      background: linear-gradient(to right, #66bb6a, #aed581);
      transform: translateY(2px);
    }

    @media (max-width: 600px) {
      .upload-form-container {
        padding: 20px;
      }
    }
    .upload-form-container
    {
        width:100%;
    }
    
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
    }

    .pdf-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      padding: 20px;
      width: 360px;
      transition: transform 0.3s ease;
    }

    .pdf-card:hover {
      transform: translateY(-5px);
    }

    .pdf-header {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      color: #2c3e50;
    }

    .pdf-meta {
      font-size: 14px;
      color: #6c757d;
      margin-bottom: 8px;
    }

    .pdf-description {
      font-size: 15px;
      color: #444;
      margin-bottom: 15px;
    }

    .pdf-preview {
      width: 100%;
      height: 200px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .btn-download {
      display: inline-block;
      text-align: center;
      padding: 10px 16px;
      background: linear-gradient(to right, #1e88e5, #5e35b1);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-download:hover {
      background: linear-gradient(to right, #ffee58, #66bb6a);
      color: #222;
    }

</style>
         
        

      
       