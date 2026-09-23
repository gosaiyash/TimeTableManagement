<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Time Table Management, Admin page</title>
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
            <a href="index.html" class="logo">
              Logo
            </a>
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
          <div class="sidebar-content">

          
            <ul class="nav nav-secondary">
              

              <li class="nav-item">
              <ul class="nav nav-collapse">
                    
                    <li>
                      <a href="/view_subject">
                        <span class="sub-item">Download Subjects</span>
                      </a>
                    </li>
                    <li>
                      <a href="/download_course">
                        <span class="sub-item">Download Course</span>
                      </a>
                    </li>
                    
                    </li>

                    <button class="btn"><a href="/admin">Back</a></button>

                  </ul>
              </li>            
            </ul>            
          </div>
        </div>
      </div>

      <div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>


     
    </div>
</body>
</html>

<style>
  .btn{
  margin-left:65px;
  margin-top:15px;
  color:black;
  background-color:blue;
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
  margin-left:410px;  
  border:1px solid black;
  border-radius:12px;
  width:55vw;

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

</style>
         
        

      
       