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
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="../demo1/index.html">
                        <span class="sub-item"></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
               
              <div class="formdiv">
          <div class="back-button">
            <a href="/viewsubject" class="btn-back">
              <i class="fas fa-arrow-left"></i> Back to Subjects
            </a>
          </div>
            </ul>
          </div>
        </div>
      </div>

      
      <div class="formdiv">
      <form method="POST" action="{{ url('update_subject') }}">
      @if(Session::has('subjectadd'))
        <div class="alert alert-success">
            {{ Session::get('subjectadd') }}
        </div>
        @endif
        
        <h1 id="h1title">Subject Details</h1>

          <div class="row register-form">
             @csrf
             <div class="form-text">            
               
                <div class="form-group">
                  <label for="">Subject Code</label>
                  <input type="text" class="form-control" placeholder="#123345567" id="subject_code" name="subject_code" value="{{ $rec->subject_code }}" />
                 </div>       
                 
                 <input type="hidden" class="form-control" id="id" name="id" value="{{ $rec->id }}" />

              <div class="form-text">            
                <div class="form-group">
                  <label for="">Subject Name</label>
                  <input type="text" class="form-control" placeholder="#abcd.." id="subject_name" name="subject_name" value="{{ $rec->subject_name }}" />
                </div>     
              </div>
              <div class="form-text">            
                <div class="form-group">
                  <label for="">Total Lectures</label>
                  <input type="text" class="form-control" placeholder="#36" id="total_lectures" name="total_lectures" value="{{ $rec->total_lectures }}" />
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
</body>
</html>

<style>
/* Navigation and Sidebar Styles */
.sidebar {
  width: 260px;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  z-index: 1000;
  transition: all 0.3s ease;
  background: linear-gradient(180deg, #2c3e50 0%, #3498db 100%);
}

.sidebar-logo {
  padding: 15px;
  background: rgba(0, 0, 0, 0.1);
}

.logo-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 0;
}

.nav-toggle {
  display: flex;
  gap: 10px;
}

.btn-toggle {
  background: transparent;
  border: none;
  color: white;
  padding: 8px;
  cursor: pointer;
  border-radius: 4px;
  transition: all 0.3s ease;
}

.btn-toggle:hover {
  background: rgba(255, 255, 255, 0.1);
}

.topbar-toggler {
  background: transparent;
  border: none;
  color: white;
  padding: 8px;
  cursor: pointer;
  border-radius: 4px;
  transition: all 0.3s ease;
}

.topbar-toggler:hover {
  background: rgba(255, 255, 255, 0.1);
}

/* Sidebar Navigation Styles */
.sidebar-wrapper {
  padding: 20px 0;
  height: calc(100vh - 80px);
  overflow-y: auto;
}

.sidebar-content {
  padding: 0 20px;
}

.nav-secondary {
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-item {
  margin-bottom: 5px;
}

.nav-item a {
  display: flex;
  align-items: center;
  padding: 12px 15px;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.nav-item a:hover {
  background: rgba(255, 255, 255, 0.1);
  color: white;
}

.nav-item i {
  margin-right: 10px;
  width: 20px;
  text-align: center;
}

.nav-item p {
  margin: 0;
  flex-grow: 1;
}

.nav-collapse {
  list-style: none;
  padding-left: 20px;
  margin: 5px 0;
}

.nav-collapse a {
  padding: 8px 15px;
  font-size: 0.9em;
}

/* Form Styles */
.main {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f5f5f5;
  margin-left: 260px;
  transition: all 0.3s ease;
}

.formdiv {
  position: relative;
  margin-top: 80px;
  padding: 0;
  width: 100%;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

form {
  padding: 40px;
  margin-top: 35px;
  margin-left: 135px;
  width: 55vw;
  border: none;
  border-radius: 15px;
  background: white;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#h1title {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
  font-size: 28px;
  font-weight: 600;
}

.form-text {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

.form-group {
  width: 100%;
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  color: #555;
  font-weight: 500;
  font-size: 14px;
}

.form-control {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
  transition: border-color 0.3s ease;
}

.form-control:focus {
  outline: none;
  border-color: #4a90e2;
  box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

.button {
  background: linear-gradient(to right, #4a90e2, #5c6bc0);
  border: none;
  color: white;
  padding: 12px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  font-weight: 500;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  margin-left: 245px;
  width: 10vw;
}

.button:hover {
  background: linear-gradient(to right, #357abd, #4a5aa9);
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
  transform: translateY(-2px);
}

.button:active {
  background: linear-gradient(to right, #357abd, #4a5aa9);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transform: translateY(1px);
}

.alert {
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 8px;
}

.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}

/* Responsive Design */
@media (max-width: 768px) {
  .sidebar {
    width: 0;
    transform: translateX(-100%);
  }
  
  .sidebar.active {
    width: 260px;
    transform: translateX(0);
  }
  
  .main {
    margin-left: 0;
  }
  
  .formdiv {
    margin-left: 0;
    width: 100%;
  }
  
  form {
    margin-left: 20px;
    width: 90%;
  }
  
  .button {
    margin-left: 0;
    width: 100%;
  }
}

/* Back Button Styles */
.back-button {
  position: absolute;
  top: 20px;
  left: 280px;
  z-index: 100;
}

.btn-back {
  display: inline-flex;
  align-items: center;
  padding: 12px 24px;
  background: #3498db;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  transition: all 0.3s ease;
  font-weight: 500;
  font-size: 16px;
  box-shadow: 0 2px 10px rgba(52, 152, 219, 0.2);
}

.btn-back i {
  margin-right: 10px;
  font-size: 16px;
}

.btn-back:hover {
  background: #2980b9;
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
}

.btn-back:active {
  transform: translateY(0);
  box-shadow: 0 2px 5px rgba(52, 152, 219, 0.2);
}
</style>
         
        

      
       