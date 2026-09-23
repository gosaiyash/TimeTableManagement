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
        <a href="/view_services" class="btn-back">
          <i class="fas fa-arrow-left"></i> Back to Services
        </a>
        </div>
        </div>
      </div>

      
      <div class="formdiv">
      <form method="POST" action="{{ url('services_update1') }}" enctype="multipart/form-data">
      @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        
        <h1 id="h1title">Update Services Details</h1>

          <div class="row register-form">
             @csrf
             <div class="form-text">            
               
                <div class="form-group">
                <input type="hidden" class="form-control" placeholder="#abc..." id="id" name="id"  value="{{ $rec->id }}" />
               
                  <label for="">Services Name</label>
                  <input type="text" class="form-control" placeholder="#abc..." id="s_name" name="s_name"  value="{{ $rec->s_name }}" />
                 </div>           
              <div class="form-text">            
                <div class="form-group">
                  <label for="">Description</label>
                  <input type="text" class="form-control" placeholder="#abcd.." id="description" name="description" value="{{ $rec->description }}" />
                </div>     
              </div>
              <div class="form-group">
              <label for="">Services image</label>
                <input type="file" class="form-control item" id="img" name="img" placeholder="image">
				@error('img')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
              <!-- <div class="form-text">            
                <div class="form-group">
                  <label for="">Services image</label>
                  <input type="file" class="form-control" id="img" name="img" value="" />
                </div>     
              </div> -->
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

/* Back Button Styles */
.back {
  padding: 20px;
  margin-bottom: 20px;
}

.btn-back {
  display: inline-flex;
  align-items: center;
  padding: 12px 20px;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  text-decoration: none;
  border-radius: 8px;
  transition: all 0.3s ease;
  font-weight: 500;
  font-size: 14px;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-back i {
  margin-right: 8px;
  font-size: 14px;
}

.btn-back:hover {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  text-decoration: none;
  transform: translateX(-3px);
}

.btn-back:active {
  transform: translateX(0);
  background: rgba(255, 255, 255, 0.15);
}

/* Main Layout */
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
  margin-top: 40px;
  padding: 0;
  width: 100%;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

/* Form Styles */
form {
  padding: 40px;
  margin: 20px;
  background: white;
  border: none;
  border-radius: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 700px;
}

#h1title {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
  font-size: 28px;
  font-weight: 600;
}

.form-text {
  margin-bottom: 20px;
  width: 100%;
}

.form-group {
  margin-bottom: 20px;
  width: 100%;
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

/* File Input Styling */
input[type="file"].form-control {
  padding: 8px;
  background-color: #f8f9fa;
  border: 2px dashed #ddd;
  cursor: pointer;
}

input[type="file"].form-control:hover {
  border-color: #4a90e2;
  background-color: #f0f7ff;
}

/* Button Styling */
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
  width: auto;
  min-width: 120px;
}

.button:hover {
  background: linear-gradient(to right, #357abd, #4a5aa9);
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
  transform: translateY(-2px);
}

.button:active {
  transform: translateY(1px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Alert Styles */
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

.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
  font-size: 14px;
  margin-top: 5px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .main {
    margin-left: 0;
  }
  
  .formdiv {
    margin: 20px;
    padding: 0;
  }
  
  form {
    margin: 10px;
    padding: 20px;
  }
  
  .button {
    width: 100%;
    margin-left: 0;
  }
}
</style>
         
        

      
       