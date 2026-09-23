<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>View Student - Time Table Management</title>
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
              <a href="/viewdata" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to View Data
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="main-content">
        <div class="container">
          <div class="page-header">
            <h1 class="page-title">View Student Data</h1>
            <p class="page-description">Manage and view all student information</p>
          </div>

          @if(Session::has('success'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ Session::get('success') }}
          </div>
          @endif

          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>ID</th>
                      <th>Enrollment No</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Sem</th>
                      <th>Email</th>
                      <th>Birth Date</th>
                      <th>Created</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($rec as $r)
                    <tr>
                      <td>
                        <div class="student-image">
                          <img src="{{ $r->img }}" alt="Student Image" class="img-thumbnail">
                        </div>
                      </td>
                      <td>{{ $r->id }}</td>
                      <td>{{ $r->enrollment_no }}</td>
                      <td>{{ $r->first_name }}</td>
                      <td>{{ $r->last_name }}</td>
                      <td>{{ $r->sem }}</td>
                      <td>{{ $r->email }}</td>
                      <td>{{ $r->birthdate }}</td>
                      <td>{{ $r->created_at }}</td>
                      <td>
                        @if($r->deleted == 1)
                        <span class="badge badge-danger">Inactive/Removed</span>
                        @else
                        <span class="badge badge-success">Active</span>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('demo', ['id' => $r->id]) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <a href="{{ route('deletestud', ['id' => $r->id]) }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
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

.sidebar-content {
  padding: 0 1rem;
}

.back-button {
  padding: 1rem;
  margin-top: auto;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
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

/* Table Styles */
.table-responsive {
  overflow-x: auto;
  border-radius: 8px;
}

.table {
  width: 100%;
  margin-bottom: 0;
  color: var(--dark-color);
  border-collapse: separate;
  border-spacing: 0;
}

.table thead th {
  background: var(--light-color);
  color: var(--dark-color);
  font-weight: 600;
  padding: 1rem;
  border-bottom: 2px solid var(--border-color);
  position: sticky;
  top: 0;
  z-index: 10;
}

.table tbody tr {
  transition: all var(--transition-speed) ease;
}

.table tbody tr:hover {
  background-color: rgba(78, 115, 223, 0.05);
}

.table tbody td {
  padding: 1rem;
  vertical-align: middle;
  border-bottom: 1px solid var(--border-color);
}

/* Student Image Styles */
.student-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;
}

.student-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Badge Styles */
.badge {
  padding: 0.5rem 0.75rem;
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 50rem;
  display: inline-block;
}

.badge-success {
  background-color: rgba(28, 200, 138, 0.1);
  color: var(--success-color);
}

.badge-danger {
  background-color: rgba(231, 74, 59, 0.1);
  color: var(--danger-color);
}

/* Button Styles */
.btn {
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
  font-weight: 500;
  border-radius: 8px;
  transition: all var(--transition-speed) ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}

.btn-info {
  background: rgba(54, 162, 235, 0.1);
  color: #36a2eb;
  border: none;
}

.btn-danger {
  background: rgba(231, 74, 59, 0.1);
  color: var(--danger-color);
  border: none;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-group {
  display: flex;
  gap: 5px;
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

  .card-body {
    padding: 1rem;
  }
  
  .table-responsive {
    border-radius: 0;
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
       