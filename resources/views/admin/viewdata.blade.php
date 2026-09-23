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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
  </head>
  <body>
    <div class="main">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <div class="user-profile">
              @if(Session::has('admin_id'))
                <div class="admin-profile">
                  <div class="avatar-container">
                    <img src="{{ Session::get('admin_image') }}" alt="Admin Image" class="admin-avatar">
                    <div class="avatar-status"></div>
                  </div>
                  <div class="admin-info">
                    <h2 class="admin-name">{{ Session::get('admin_name') }}</h2>
                    <span class="admin-role">Administrator</span>
                  </div>
                </div>
              @endif
            </div>

            <div class="sidebar-divider"></div>

            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a class="nav-link" href="/viewcouse">
                  <i class="fas fa-book"></i>
                  <span>View Course</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/viewfaculty">
                  <i class="fas fa-chalkboard-teacher"></i>
                  <span>View Faculty Details</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/viewsubject">
                  <i class="fas fa-book-open"></i>
                  <span>View Subject Details</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/viewstudent">
                  <i class="fas fa-user-graduate"></i>
                  <span>View Students Details</span>
                </a>
              </li>
      
              <li class="nav-item">
                <a class="nav-link" href="/view_services">
                  <i class="fas fa-cogs"></i>
                  <span>View Services</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/view_subject">
                  <i class="fas fa-file-pdf"></i>
                  <span>View Subject in PDF</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/view-faculty-sets') }}">
                  <i class="fas fa-tasks"></i>
                  <span>View Faculty Sets</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link back-button" href="/admin">
                  <i class="fas fa-arrow-left"></i>
                  <span>Back to Dashboard</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="main-content">
        @if(Session::has('success'))
          <div class="alert alert-success fade show" role="alert">
            <i class="fas fa-check-circle alert-icon"></i>
            <span>{{ Session::get('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <div class="content-wrapper">
          <div class="page-header">
            <h1 class="page-title">Data Management</h1>
            <p class="page-description">View and manage all system data from one place</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<style>
/* Global Styles */
:root {
    --primary-color: #4e73df;
    --secondary-color: #224abe;
    --success-color: #1cc88a;
    --warning-color: #f6c23e;
    --danger-color: #e74a3b;
    --dark-color: #2d3748;
    --light-color: #f8f9fc;
    --sidebar-width: 250px;
    --header-height: 70px;
    --transition-speed: 0.3s;
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--light-color);
    margin: 0;
    overflow-x: hidden;
}

/* Main Layout */
.main {
    display: flex;
    min-height: 100vh;
}

/* Sidebar Styles */
.sidebar {
    width: var(--sidebar-width);
    background: linear-gradient(135deg, var(--dark-color) 0%, #1a202c 100%);
    position: fixed;
    height: 100vh;
    left: 0;
    top: 0;
    z-index: 1000;
    transition: all var(--transition-speed) ease;
}

.sidebar-wrapper {
    height: 100%;
    overflow-y: auto;
    padding: 20px 0;
}

/* Hide scrollbar but allow scrolling */
.sidebar-wrapper::-webkit-scrollbar {
    width: 0;
    background: transparent;
}

/* User Profile Section */
.user-profile {
    padding: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 20px;
}

.admin-profile {
    display: flex;
    align-items: center;
    gap: 15px;
}

.avatar-container {
    position: relative;
}

.admin-avatar {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.2);
    transition: all var(--transition-speed) ease;
}

.avatar-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background: var(--success-color);
    border-radius: 50%;
    border: 2px solid var(--dark-color);
}

.admin-info {
    flex: 1;
}

.admin-name {
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    line-height: 1.2;
}

.admin-role {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
}

/* Navigation Items */
.nav-secondary {
    padding: 0;
    margin: 0;
    list-style: none;
}

.nav-item {
    margin: 5px 15px;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    transition: all var(--transition-speed) ease;
    text-decoration: none;
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
    margin-left: var(--sidebar-width);
    padding: 20px;
    background: var(--light-color);
    min-height: 100vh;
}

/* Alert Styles */
.alert {
    border: none;
    border-radius: 12px;
    padding: 15px 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    animation: slideIn 0.5s ease;
}

.alert-success {
    background: rgba(28, 200, 138, 0.1);
    border-left: 4px solid var(--success-color);
    color: var(--success-color);
}

.alert-icon {
    font-size: 1.2rem;
}

.alert .close {
    margin-left: auto;
    font-size: 1.1rem;
    color: currentColor;
    opacity: 0.7;
    transition: all var(--transition-speed) ease;
}

.alert .close:hover {
    opacity: 1;
}

/* Page Header */
.page-header {
    margin-bottom: 2rem;
    padding: 1rem 0;
}

.page-title {
    font-size: 2rem;
    font-weight: 600;
    color: var(--dark-color);
    margin: 0;
}

.page-description {
    color: #718096;
    margin: 0.5rem 0 0;
    font-size: 1rem;
}

/* Back Button */
.back-button {
    margin-top: 20px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.back-button:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Animations */
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
    }

    .nav-link span {
        display: none;
    }

    .admin-profile {
        flex-direction: column;
        text-align: center;
    }

    .admin-info {
        margin-top: 10px;
    }
}
</style>
         
        

      
       