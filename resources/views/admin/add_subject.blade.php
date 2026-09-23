<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Add Subject - Time Table Management</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
            <a href="/admin" class="logo">
              <i class="fas fa-calendar-alt"></i>
              <span>TimeTable</span>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="fas fa-bars"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="fas fa-ellipsis-v"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <div class="back-button">
              <a href="/addforms" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Forms
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="main-content">
        <div class="container">
          <div class="page-header">
            <h1 class="page-title">Add Subject</h1>
            <p class="page-description">Enter the subject details below</p>
          </div>

          @if(Session::has('subjectadd'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ Session::get('subjectadd') }}
          </div>
          @endif

          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ url('add_subject') }}">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subject_code">Subject Code</label>
                      <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="Enter subject code" />
                      @error('subject_code')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subject_name">Subject Name</label>
                      <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter subject name" />
                      @error('subject_name')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="total_lectures">Total Lectures</label>
                      <input type="text" class="form-control" id="total_lectures" name="total_lectures" placeholder="Enter total lectures" />
                      @error('total_lectures')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group text-right">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>

<style>
:root {
  --primary-color: #4e73df;
  --secondary-color: #224abe;
  --success-color: #1cc88a;
  --warning-color: #f6c23e;
  --danger-color: #e74a3b;
  --dark-color: #2d3748;
  --light-color: #f8f9fc;
  --border-color: #e3e6f0;
  --text-muted: #858796;
  --transition-speed: 0.3s;
}

body {
  font-family: 'Poppins', sans-serif;
  background: var(--light-color);
  margin: 0;
  padding: 0;
}

.main {
  display: flex;
  min-height: 100vh;
}

/* Sidebar Styles */
.sidebar {
  width: 250px;
  background: linear-gradient(135deg, var(--dark-color) 0%, #1a202c 100%);
  position: fixed;
  height: 100vh;
  left: 0;
  top: 0;
  z-index: 1000;
  transition: all var(--transition-speed) ease;
}

.sidebar-logo {
  padding: 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.logo-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #ffffff;
  text-decoration: none;
  font-size: 1.5rem;
  font-weight: 600;
}

.logo i {
  font-size: 1.8rem;
  color: var(--primary-color);
}

.nav-toggle {
  display: flex;
  gap: 5px;
}

.btn-toggle {
  background: transparent;
  border: none;
  color: rgba(255, 255, 255, 0.7);
  padding: 5px;
  cursor: pointer;
  transition: all var(--transition-speed) ease;
}

.btn-toggle:hover {
  color: #ffffff;
}

.sidebar-wrapper {
  padding: 1rem 0;
  height: calc(100vh - 70px);
  overflow-y: auto;
}

/* Main Content Area */
.main-content {
  flex: 1;
  margin-left: 250px;
  padding: 2rem;
}

/* Page Header */
.page-header {
  margin-bottom: 2rem;
}

.page-title {
  color: var(--dark-color);
  font-size: 2rem;
  font-weight: 600;
  margin: 0;
}

.page-description {
  color: var(--text-muted);
  margin: 0.5rem 0 0;
}

/* Card Styles */
.card {
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
  margin-bottom: 1.5rem;
}

.card-body {
  padding: 1.5rem;
}

/* Form Styles */
.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  color: var(--dark-color);
  font-weight: 500;
}

.form-control {
  width: 100%;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  transition: all var(--transition-speed) ease;
}

.form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
  outline: none;
}

/* Button Styles */
.btn {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
  color: white;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all var(--transition-speed) ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(78, 115, 223, 0.2);
}

.back-button {
  padding: 1rem;
  margin-top: auto;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* Alert Styles */
.alert {
  padding: 1rem;
  border-radius: 8px;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 10px;
  animation: slideIn 0.3s ease;
}

.alert-success {
  background: rgba(28, 200, 138, 0.1);
  color: var(--success-color);
  border-left: 4px solid var(--success-color);
}

.alert-danger {
  background: rgba(231, 74, 59, 0.1);
  color: var(--danger-color);
  border-left: 4px solid var(--danger-color);
}

@keyframes slideIn {
  from {
    transform: translateY(-20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Responsive Design */
@media (max-width: 768px) {
  .sidebar {
    transform: translateX(-100%);
  }

  .sidebar.active {
    transform: translateX(0);
  }

  .main-content {
    margin-left: 0;
    padding: 1rem;
  }

  .card-body {
    padding: 1rem;
  }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.3);
}
</style>
         
        

      
       