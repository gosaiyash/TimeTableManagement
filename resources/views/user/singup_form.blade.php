<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
	<div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>
    <div class="registration-form">
        <form action="{{ url('/student_singup') }}" method="post" enctype="multipart/form-data">
		@csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                
                <input type="text" class="form-control item" name="firstname" id="firstname" placeholder="Student Name">
				@error('firstname')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror

			</div>
			<div class="form-group">
                <input type="text" class="form-control item" name="lastname" id="lastname" placeholder="Father Name">
				@error('lastname')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
                <input type="text" class="form-control item" name="enrollment_no" id="enrollment_no" placeholder="Enrollment Number *">
				@error('enrollment_no')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
                <input type="text" class="form-control item"name="sem"  id="sem" placeholder="Semester">
				@error('sem')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
                <input type="date" class="form-control item" name="birthdate" id="birthdate">
				@error('birthdate')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" name="email" id="email" placeholder="Email">
				@error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="password" placeholder="Password">
            </div>
			<div class="form-group">
				<!-- <p>Student Image :- </p> -->
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="student_img" name="student_img">
                    <label class="custom-file-label" for="student_img">Choose profile image</label>
                </div>
				@error('student_img')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>

           
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Create Account</button>
            </div>
            <!-- <div class="form-group">
                <p>already have account ? <a href="/login">Login</a></p>  
            </div> -->
        </form>
        <!-- <div class="social-media">
            <h5>Sign up with social media</h5>
            <div class="social-icons">
                <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                <a href="#"><i class="icon-social-google" title="Google"></i></a>
                <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
            </div>
        </div> -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Update file input label with selected filename
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
</body>
</html>
<style>
body {
    background: #f5f5f5;
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    margin: 0;
}

.registration-form {
    width: 100%;
    max-width: 500px;
}

.registration-form form {
    background: #ffffff;
    padding: 40px;
    border-radius: 24px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.form-icon {
    text-align: center;
    margin-bottom: 30px;
    display: none; /* Hidden as per screenshot */
}

.form-group {
    margin-bottom: 20px;
}

.form-control.item {
    width: 100%;
    padding: 12px 16px;
    height: 48px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    background-color: #fff;
    color: #333;
    transition: all 0.3s ease;
}

.form-control.item:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.1);
    outline: none;
}

.form-control.item::placeholder {
    color: #666;
    opacity: 0.7;
}

.alert {
    border-radius: 12px;
    padding: 12px 16px;
    margin-bottom: 16px;
    font-size: 14px;
}

.alert-danger {
    background-color: #fff2f0;
    border: 1px solid #ffccc7;
    color: #ff4d4f;
}

.alert-success {
    background-color: #f6ffed;
    border: 1px solid #b7eb8f;
    color: #52c41a;
}

.custom-file {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
}

.custom-file-input {
    position: absolute;
    height: 48px;
    width: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.custom-file-label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    height: 48px;
    padding: 12px 16px;
    font-weight: 400;
    line-height: 24px;
    color: #666;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    cursor: pointer;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.custom-file-label::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #fff;
    content: "Browse";
    background-color: #4a90e2;
    border-radius: 0 12px 12px 0;
}

.create-account {
    width: 100%;
    height: 48px;
    background-color: #4a90e2;
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

.create-account:hover {
    background-color: #357abd;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.2);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .registration-form form {
        padding: 30px 20px;
    }
}

/* Animation for form elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group {
    animation: fadeInUp 0.4s ease forwards;
    opacity: 0;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.15s; }
.form-group:nth-child(3) { animation-delay: 0.2s; }
.form-group:nth-child(4) { animation-delay: 0.25s; }
.form-group:nth-child(5) { animation-delay: 0.3s; }
.form-group:nth-child(6) { animation-delay: 0.35s; }
.form-group:nth-child(7) { animation-delay: 0.4s; }
.form-group:nth-child(8) { animation-delay: 0.45s; }

/* Input focus effect */
.form-control:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.1);
}

/* Date input specific styling */
input[type="date"] {
    color: #666;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    opacity: 0.7;
    cursor: pointer;
}

/* Remove autofill background */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0px 1000px #fff inset;
    transition: background-color 5000s ease-in-out 0s;
}
</style>