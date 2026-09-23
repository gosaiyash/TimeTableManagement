

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
        <ul class="nav nav-secondary">
              

              <li class="nav-item">
              <ul class="nav nav-collapse">
         
         
        <div class="back">
        <a href="/reportlist" class="btn btn-info btn-sm">Back</a>
        </div>
      </div>
        </ul>
                </li>            
              </ul>     
    
      <h2 class='headertitle'>Generate Report</h2>
      
    <div class="formdiv">
 
    <form action="{{ url('/coursreportgenerate') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <label for="languages">Subject Name:</label>
      <select id="subject_name" name="subject_name">
        @foreach($rec as $rec1)
        <option value="{{ $rec1->subject_name }}">{{ $rec1->subject_name }}</option>
        @endforeach
      </select><br><br>

      <label for="languages">Faculty Name:</label>
      <select id="faculty_name" name="faculty_name">
        @foreach($rec as $rec1)
        <option value="{{ $rec1->faculty_name }}">{{ $rec1->faculty_name }}</option>
        @endforeach
      </select><br><br>

      <!-- <label for="languages">Total Lectures :</label>
      <select id="total_lec" name="total_lec">
        @foreach($rec as $rec1)
        <option value="{{ $rec1->total_lec }}">{{ $rec1->total_lec }}</option>
        @endforeach
      </select><br><br> -->
      
        <button type="submit">Generat Report</button>
    </form>
      </div>
      <div class="formdiv">
 
 <form action="{{ url('/coursreportgenerate1') }}" method="POST" enctype="multipart/form-data">
 @csrf
   <label for="languages">Subject Name:</label>
   <select id="subject_name" name="subject_name">
     @foreach($rec as $rec1)
     <option value="{{ $rec1->subject_name }}">{{ $rec1->subject_name }}</option>
     @endforeach
   </select><br><br>

   <!-- <label for="languages">Faculty Name:</label>
   <select id="faculty_name" name="faculty_name">
     @foreach($rec as $rec1)
     <option value="{{ $rec1->faculty_name }}">{{ $rec1->faculty_name }}</option>
     @endforeach
   </select><br><br> -->

   <!-- <label for="languages">Total Lectures :</label>
   <select id="total_lec" name="total_lec">
     @foreach($rec as $rec1)
     <option value="{{ $rec1->total_lec }}">{{ $rec1->total_lec }}</option>
     @endforeach
   </select><br><br> -->
   
     <button type="submit">Generat Report</button>
 </form>
   </div>
 
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
form
{
  padding:15px;
  margin:auto;
  margin-top:65px;  
  margin-left:610px;  
  border:1px solid black;
  border-radius:12px;
  width:25vw;

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
.headertitle
{
  margin-left:630px;
  font-family:bold;
  font-size:2.5em;
}


</style>
         
        

      
       