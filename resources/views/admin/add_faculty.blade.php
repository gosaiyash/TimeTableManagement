@extends('admin.layouts.admin')

@section('title', 'Add Faculty - Time Table Management')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Add Faculty</h1>
        <p class="page-description">Add new faculty members to the system</p>
    </div>

    @if(Session::has('faculty'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle alert-icon"></i>
        {{ Session::get('faculty') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('add_faculty') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="faculty_code">Faculty Code</label>
                            <input type="text" class="form-control" id="faculty_code" name="faculty_code" placeholder="Enter faculty code">
                            @error('faculty_code')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="faculty_name">Faculty Name</label>
                            <input type="text" class="form-control" id="faculty_name" name="faculty_name" placeholder="Enter faculty name">
                            @error('faculty_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="faculty_mo">Mobile Number</label>
                            <input type="text" class="form-control" id="faculty_mo" name="faculty_mo" placeholder="Enter mobile number">
                            @error('faculty_mo')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                            @error('email')
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
@endsection

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

.topbar-toggler {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    padding: 5px;
    cursor: pointer;
    transition: all var(--transition-speed) ease;
}

.topbar-toggler:hover {
    color: #ffffff;
}

.sidebar-wrapper {
    padding: 1rem 0;
    height: calc(100vh - 70px);
    overflow-y: auto;
}

/* User Profile Section */
.user-profile {
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 1rem;
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
    width: 50px;
    height: 50px;
    border-radius: 12px;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.avatar-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: var(--success-color);
    border-radius: 50%;
    border: 2px solid var(--dark-color);
}

.admin-info {
    flex: 1;
}

.admin-name {
    color: #ffffff;
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
    line-height: 1.2;
}

.admin-role {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
    margin: 0;
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
.formdiv {
    flex: 1;
    padding: 40px;
    margin-left: 250px;
}

form {
    background: #ffffff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    max-width: 800px;
    margin: 0 auto;
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

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: none;
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

.button {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-speed) ease;
    width: 100%;
    margin-top: 1rem;
}

.button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .formdiv {
        margin-left: 0;
        padding: 20px;
    }

    form {
        padding: 20px;
    }

    #h1title {
        font-size: 1.5rem;
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

         
        

      
       