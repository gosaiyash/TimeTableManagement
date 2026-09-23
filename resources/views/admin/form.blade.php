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
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="/add_faculty" class="nav-link">
                      <i class="fas fa-user-tie"></i>
                      <span class="sub-item">Add Faculty Details</span>
                    </a>
                  </li>
                  <li>
                    <a href="/add_subject" class="nav-link">
                      <i class="fas fa-book"></i>
                      <span class="sub-item">Add Subjects Details</span>
                    </a>
                  </li>
                  <li>
                    <a href="/add_services" class="nav-link">
                      <i class="fas fa-cogs"></i>
                      <span class="sub-item">Add Services Details</span>
                    </a>
                  </li>
                  <li>
                    <a href="/setdata" class="nav-link">
                      <i class="fas fa-link"></i>
                      <span class="sub-item">Set Faculty & Subjects</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <div class="back-button">
              <a href="/admin" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="main-content">
        @if(Session::has('success'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i>
          {{ Session::get('success') }}
        </div>
        @endif
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

/* Navigation Items */
.nav-secondary {
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-item {
  margin: 5px 15px;
}

.nav-link {
  display: flex;
  align-items: center;
  padding: 12px 20px;
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  border-radius: 12px;
  transition: all var(--transition-speed) ease;
}

.nav-link:hover {
  color: #ffffff;
  background: rgba(255, 255, 255, 0.1);
  transform: translateX(5px);
}

.nav-link i {
  font-size: 1.2rem;
  margin-right: 12px;
  width: 20px;
  text-align: center;
}

.nav-link span {
  flex: 1;
}

/* Main Content Area */
.main-content {
  flex: 1;
  margin-left: 250px;
  padding: 2rem;
}

/* Form Styles */
form {
  background: #ffffff;
  padding: 2rem;
  border-radius: 16px;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
  max-width: 800px;
  margin: 2rem auto;
}

#h1title {
  color: var(--dark-color);
  font-size: 2rem;
  font-weight: 600;
  text-align: center;
  margin-bottom: 2rem;
}

.form-text {
  margin-bottom: 1.5rem;
}

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

  form {
    padding: 1rem;
  }

  .nav-link span {
    display: none;
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
         
        

      
       