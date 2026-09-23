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
              @else
                <li class="nav-item">
                  <a class="nav-link" href="/admin_r">
                    <i class="fas fa-user-plus"></i>
                    <p>Add Admins</p>
                  </a>
                </li>
              @endif
            </div>

            <div class="sidebar-divider"></div>

         
            <ul class="nav nav-secondary">
            <li class="nav-item">
                <a class="nav-link" href="/upload_ttm">
                  <i class="fas fa-plus-circle"></i>
                  <span>Send Time Table</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/addforms">
                  <i class="fas fa-plus-circle"></i>
                  <span>Forms</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/viewdata">
                  <i class="fas fa-table"></i>
                  <span>View Data</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/sortsubject">
                  <i class="fas fa-calendar-alt"></i>
                  <span>Generate Time Table</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/datadownload">
                  <i class="fas fa-download"></i>
                  <span>Download Data</span>
                  <span class="badge">1</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/openmail">
                  <i class="fas fa-envelope"></i>
                  <span>Send Mail</span>
                  <span class="badge">1</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/reportlist">
                  <i class="fas fa-chart-bar"></i>
                  <span>Reports</span>
                  <span class="badge">1</span>
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
            <h1 class="page-title">Time Tables Overview</h1>
            <div class="page-header-actions">
              <a href="/sortsubject" class="btn btn-primary">
                <i class="fas fa-plus"></i> Generate New Time Table
              </a>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Semester</th>
                      <th>Description</th>
                      <th>File</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($timetables as $timetable)
                      <tr>
                        <td>{{ $timetable->date }}</td>
                        <td>
                          <span class="semester-badge">Semester {{ $timetable->sem }}</span>
                        </td>
                        <td>{{ $timetable->description }}</td>
                        <td>
                          <div class="pdf-preview-container">
                            <iframe src="{{ $timetable->path }}#toolbar=0&navpanes=0" class="pdf-preview" type="application/pdf"></iframe>
                          </div>
                        </td>
                        <td>
                          <div class="action-buttons">
                            <a href="{{ $timetable->path }}" class="btn btn-sm btn-info" download>
                              <i class="fas fa-download"></i>
                            </a>
                            <a href="{{ $timetable->path }}" class="btn btn-sm btn-primary" target="_blank">
                              <i class="fas fa-eye"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
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

.badge {
    background: var(--primary-color);
    color: #ffffff;
    padding: 3px 8px;
    border-radius: 20px;
    font-size: 0.75rem;
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

/* Custom Scrollbar for Webkit Browsers */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Page Header Styles */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 0.5rem 0;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--dark-color);
    margin: 0;
}

.page-header-actions .btn {
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all var(--transition-speed) ease;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border: none;
    color: #ffffff;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.2);
}

/* Card Styles */
.card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    transition: all var(--transition-speed) ease;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 1.5rem;
}

/* Table Styles */
.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

.table {
    width: 100%;
    margin-bottom: 0;
}

.table thead th {
    background: var(--light-color);
    color: var(--dark-color);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 1rem;
    border-top: none;
}

.table tbody tr {
    transition: all var(--transition-speed) ease;
}

.table tbody tr:hover {
    background: rgba(78, 115, 223, 0.05);
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    border-color: #f0f2f5;
}

/* Semester Badge */
.semester-badge {
    background: rgba(78, 115, 223, 0.1);
    color: var(--primary-color);
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

/* PDF Preview */
.pdf-preview-container {
    width: 120px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #f0f2f5;
}

.pdf-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.4rem;
    border-radius: 8px;
    transition: all var(--transition-speed) ease;
}

.btn-info {
    background: var(--primary-color);
    border: none;
    color: #ffffff;
}

.btn-info:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}

.btn i {
    font-size: 1rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1.5rem;
    color: #718096;
}

.empty-state i {
    font-size: 3rem;
    color: #cbd5e0;
    margin-bottom: 1rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .table-responsive {
        margin: 0 -1.5rem;
        width: calc(100% + 3rem);
    }

    .pdf-preview-container {
        width: 100px;
        height: 70px;
    }
}
</style>

<script>
// Add active class to current nav item
document.addEventListener('DOMContentLoaded', function() {
    const currentLocation = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        if(link.getAttribute('href') === currentLocation) {
            link.parentElement.classList.add('active');
        }
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});

// Add table row hover effect
document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('.table tbody tr');
    
    tableRows.forEach(row => {
        row.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        row.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
         
        

      
       