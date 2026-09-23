<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Generate Student Report</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
</head>
<body>
    <div class="main">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="back">
                    <a href="/reportlist" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back to Reports
                    </a>
                </div>
            </div>
        </div>

        <div class="formdiv">
            <div class="report-container">
                <h1 id="h1title">Generate Student Report</h1>

                <div class="search-section">
                    <form method="POST" action="{{ url('search_student') }}" class="search-form">
                        @csrf
                        <div class="form-group">
                            <label for="enrollment_start">From Enrollment No.</label>
                            <input type="text" class="form-control" id="enrollment_start" name="enrollment_start" placeholder="Start Enrollment Number" required>
                        </div>
                        <div class="form-group">
                            <label for="enrollment_end">To Enrollment No.</label>
                            <input type="text" class="form-control" id="enrollment_end" name="enrollment_end" placeholder="End Enrollment Number" required>
                        </div>
                        <button type="submit" class="button search-btn">Search</button>
                    </form>
                </div>

                @if(isset($students) && count($students) > 0)
                <div class="results-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Search Results</h2>
                        <form method="POST" action="{{ url('generate_combined_pdf') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="enrollment_start" value="{{ request('enrollment_start') }}">
                            <input type="hidden" name="enrollment_end" value="{{ request('enrollment_end') }}">
                            <button type="submit" class="button download-all-btn">
                                <i class="fas fa-download"></i> Download All Reports
                            </button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Enrollment No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->enrollment_no }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        <a href="{{ url('generate_pdf/'.$student->id) }}" class="btn-download">
                                            <i class="fas fa-download"></i> Download PDF
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>

<style>
/* Main Layout */
.main {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f5f5f5;
    margin-left: 260px;
}

/* Report Container */
.report-container {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin: 20px;
}

#h1title {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
    font-size: 28px;
    font-weight: 600;
}

/* Search Section */
.search-section {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
}

.search-form {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 20px;
    align-items: end;
}

.form-group {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: 500;
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

/* Button Styles */
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
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.button:hover {
    background: linear-gradient(to right, #357abd, #4a5aa9);
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.search-btn {
    height: 45px;
}

.download-all-btn {
    background: linear-gradient(to right, #28a745, #20c997);
}

.download-all-btn:hover {
    background: linear-gradient(to right, #218838, #1e7e34);
}

/* Results Section */
.results-section {
    margin-top: 30px;
}

.results-section h2 {
    color: #333;
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: 500;
}

.table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
    border-collapse: collapse;
}

.table th {
    padding: 12px;
    background: #f8f9fa;
    color: #333;
    font-weight: 600;
    text-align: left;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    padding: 12px;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}

.btn-download {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-download i {
    margin-right: 8px;
}

.btn-download:hover {
    background: #218838;
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Alert Styles */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 8px;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main {
        margin-left: 0;
    }

    .search-form {
        grid-template-columns: 1fr;
    }

    .button {
        width: 100%;
    }
}
</style>
</body>
</html> 