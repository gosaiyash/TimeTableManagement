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
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="back">
        <a href="/addforms" class="btn btn-info btn-sm">Back</a>
        </div>
        </div>
      </div>
      <!-- Faculty -->
    <div class="formdiv">
    <div>
         @if(Session::has('success'))
        <div class="alert alert-success" id="session2">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>

      <form method="POST" action="{{ url('upload_csv_file') }}" enctype="multipart/form-data">
        <h1 id="h1title">Upload CSV File For Faculty</h1>
          <div class="row register-form">
             @csrf
             <div class="form-text">            
              <div class="form-text">            
                <div class="form-group">
                  <label for="">upload CSV File :</label>
                  <input type="file" class="form-control" placeholder="csv_file *" id="csv_file" name="csv_file">
                </div>     
              </div>
          </div>

          <div class="form-text">            
             
              <div class="form-text">            
                <div class="form-group">
                 <button class="button">Sumbit</button>
               </div>     
             
          </div>
        </form>     
      </div>
      </div>
      <!-- Subjects -->

    <!-- <div class="formdiv2">
      <form method="POST" action="{{ url('subjectdata') }}">
        <h1>Subjects Details</h1>
          <div class="row register-form">
             @csrf
             <div class="form-text">            
               
                <div class="form-group">
                  <label for="">Subject Code</label>
                  <input type="text" class="form-control" placeholder="Subject code *" id="" name="" value="" />
                 </div>       
              <div class="form-text">            
                <div class="form-group">
                  <label for="">Subject Name</label>
                  <input type="text" class="form-control" placeholder="Subject Name *" id="name" name="name" value="" />
                </div>     
              </div>
              <div class="form-text">            
                <div class="form-group">
                  <label for="">Select Sem :</label><br>
                   <input type="select" class="form-control" placeholder="Sem *" id="sem" name="sem" value="" />
                  
                  <select name="sem" id="sem"> 
                  <option value="1">1 Sem</option>
                  <option value="2">2 Sem</option>
                  <option value="3">3 Sem</option>
                  <option value="4">4 Sem</option>
                  <option value="5">5 Sem</option>
                  <option value="6">6 Sem</option>
                  <option value="7">7 Sem</option>
                  <option value="8">8 Sem</option>
                  <option value="9">9 Sem</option>
                  <option value="10">10 Sem</option>  
                </select>
                </div>     
              </div>
          </div>

          <div class="form-text">            
             
              <div class="form-text">            
                <div class="form-group">
                 <button class="button">Sumbit</button>
               </div>     
             
          </div>
        </form>      -->
      </div>
       
    
</body>
</html>

<style>
.back{
   padding-left:90px;
   width:15vw;
 } 
.main
{
  display: flex;
  flex-direction:column;
}
.formdiv
{
  margin:0px;
  padding:0px;
  margin-left:280px;
  width:45vw;
}
.formdiv2
{
  margin:0px;
  padding:0px;
  /* margin-left:0px; */
  width:45vw;
}
form
{
  padding:30px;
  margin-top:35px;
  margin-left:135px;
  width:55vw;
  border:1px solid black; 
  border-radius:12px;
}
#h1title
{
  text-align:center;
}
.form-text
{
  display: flex;
  flex-direction:column;
  
}
.button {
  background: linear-gradient(to right,rgb(24, 93, 231),rgb(75, 46, 239)); /* Gradient background */
  border: none;
  color: white;
  padding: 4px 4px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px; /* Rounded corners */
  box-shadow: 0 4px #999; /* Box shadow */
  transition: all 0.3s ease-in-out; /* Smooth transitions */
  margin-left:245px;
  width:10vw;
}

/* Hover effect */
.button:hover {
  background: linear-gradient(to right,rgb(222, 251, 7), #4CAF50); /* Reverse gradient */
  box-shadow: 0 6px #666; /* Larger shadow */
  transform: translateY(-2px); /* Lift the button */
}

/* Active effect (when the button is clicked) */
.button:active {
  background: linear-gradient(to right, #4CAF50, #8BC34A); /* Reset gradient */
  box-shadow: 0 2px #666; /* Smaller shadow */
  transform: translateY(2px); /* Press the button down */
}
#sem
{
  padding:5px;
  margin-top:8px;
  font-family:bold;
  font-size:1.2em;
}

.main
{
  display: flex;
  flex-direction:column;
}

#h1title
{
  text-align:center;
}
.form-text
{
  width:50vw;
}
.form-group
{
  width:auto;
}
/* Basic button styling */

</style>

         
        

      
       