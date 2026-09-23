<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Time Table Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page-container">
        <div class="login-section">
            <div class="brand-logo">
                <i class="fas fa-calendar-alt"></i>
                <span>TTM</span>
            </div>

            <div class="login-content">
                <h1>Welcome<br>Back</h1>
                <p class="subtitle">Sign in to access your time table</p>

                <form action="{{ url('/login1') }}" method="post" class="login-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="enrollment_no" id="enrollment_no" placeholder="Enrollment Number">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="rememberMe">
                            <label for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-sign-in">Sign In</button>

                    <div class="signup-prompt">
                        <span>Don't have an account? </span>
                        <a href="/signup" class="signup-link">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<style>
:root {
    --primary-color: #4e73df;
    --text-color: #2d3748;
    --text-muted: #718096;
    --bg-color: #f8fafc;
    --input-bg: #ffffff;
    --border-color: #e2e8f0;
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg-color);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.page-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    display: flex;
    justify-content: center;
}

.login-section {
    width: 100%;
    max-width: 480px;
    padding: 2.5rem;
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.brand-logo {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--primary-color);
    font-size: 2rem;
    margin-bottom: 4rem;
}

.brand-logo i {
    font-size: 2.5rem;
}

.brand-logo span {
    font-weight: 600;
}

.login-content {
    width: 100%;
}

h1 {
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--text-color);
    line-height: 1.2;
    margin-bottom: 1rem;
}

.subtitle {
    color: var(--text-muted);
    font-size: 1.1rem;
    margin-bottom: 3rem;
}

.login-form {
    width: 100%;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    width: 100%;
    padding: 1rem 1.5rem;
    font-size: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    background: var(--input-bg);
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
}

.form-control::placeholder {
    color: #a0aec0;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.remember-me input[type="checkbox"] {
    width: 1.2rem;
    height: 1.2rem;
    border-radius: 4px;
    border: 2px solid #cbd5e0;
    cursor: pointer;
}

.remember-me label {
    color: var(--text-muted);
    cursor: pointer;
}

.forgot-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.btn-sign-in {
    width: 100%;
    padding: 1rem;
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffffff;
    background: var(--primary-color);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: var(--transition);
    margin-bottom: 2rem;
}

.btn-sign-in:hover {
    background: #3a5ccc;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
}

.signup-prompt {
    text-align: center;
    color: var(--text-muted);
}

.signup-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    margin-left: 0.25rem;
}

.signup-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .page-container {
        padding: 1.5rem;
    }

    .login-section {
        text-align: center;
    }

    h1 {
        font-size: 2.5rem;
    }

    .form-options {
        flex-direction: column;
        gap: 1rem;
    }

    .brand-logo {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-container {
        padding: 1rem;
    }

    .login-section {
        padding: 1.5rem;
        border-radius: 12px;
    }

    h1 {
        font-size: 2rem;
    }

    .brand-logo {
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }

    .brand-logo i {
        font-size: 2rem;
    }

    .subtitle {
        margin-bottom: 2rem;
    }
}
</style>
</html>