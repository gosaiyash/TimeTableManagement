<!DOCTYPE html>
<html>
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> TTM </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />



    </head>
<body>
<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="/">
        <div class="brand-box">
          <i class="fa fa-calendar brand-icon" aria-hidden="true"></i>
          <span>Time Table Management</span>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/index">
              <i class="fa fa-home nav-icon" aria-hidden="true"></i>
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">
              <i class="fa fa-sign-out nav-icon" aria-hidden="true"></i>
              Logout
            </a>
          </li>
          @if(Session::has('uid'))
            <li class="nav-item user-profile">
              <h4 class="uname">{{ Session::get('uname') }}</h4>
              <img src="{{ Session::get('uimg') }}" alt="User Image" class="userimg">
            </li>
          @else 
            <li class="nav-item">
              <a class="nav-link login-link" href="/login">
                <i class="fa fa-sign-in nav-icon" aria-hidden="true"></i>
                Login
              </a>
            </li>
          @endif
        </ul>
      </div>
    </nav>
  </div>
</header>
    
	<div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>
    <div class="registration-form">
        
        <form action="{{ url('/updatedata') }}" method="post" enctype="multipart/form-data">
		@csrf
        <h1>Update Your Profile </h1>

        

            <div class="form-icon">
                <span><img src="{{ $rec->img }}" alt="Student_img"></span>
            </div>
            
            

            <div class="form-group">
                <label for="" class="formlabel">First Name:</label>
                <input type="text" class="form-control item" name="firstname" id="firstname" value="{{ $rec->first_name }}">
				@error('firstname')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror

                <input type="hidden" class="form-control item" name="id" id="id" value="{{ $rec->id }}">
			

			</div>
			<div class="form-group">
            <label for="" class="formlabel">Last Name:</label>
                <input type="text" class="form-control item" name="lastname" id="lastname" value="{{ $rec->last_name }}">
				@error('lastname')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
            <label for="" class="formlabel">Enrollmenr No:</label>
                <input type="text" class="form-control item" name="enrollment_no" id="enrollment_no" value="{{ $rec->enrollment_no }}">
				@error('enrollment_no')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
            <label for="" class="formlabel">Sem:</label>
                <input type="text" class="form-control item"name="sem"  id="sem" value="{{ $rec->sem }}">
				@error('sem')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
			<div class="form-group">
            <label for="" class="formlabel">Birthdate:</label>
                <input type="date" class="form-control item" name="birthdate" id="birthdate" value="{{ $rec->birthdate }}">
				@error('birthdate')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
            <label for="" class="formlabel">Email :</label>
                <input type="text" class="form-control item" name="email" id="email" value="{{ $rec->email }}">
				@error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- <div class="form-group">
                <input type="text" class="form-control item" id="password" name="password" value="{{ $rec->first_name }}">
            </div> -->
			<div class="form-group">
				<!-- <p>Student Image :- </p> -->
                <label for="" class="formlabel">Upload Student Image:</label>
                <input type="file" class="form-control item" id="student_img" name="student_img">
				@error('student_img')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
			</div>
           
           
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Update Account</button>
            </div>
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
    <section class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">TTM</a>
      </p>
    </div>
  </section>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>
</html>
<style>
/* Modern Navigation Styles */
.header_section {
    padding: 15px 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: auto;
}

.navbar {
    padding: 0;
}

.brand-box {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-icon {
    font-size: 1.8rem;
    color: #ffffff;
}

.navbar-brand {
    font-size: 1.6rem;
    font-weight: 700;
    color: #ffffff !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0;
    margin: 0;
    transition: all 0.3s ease;
}

.navbar-brand:hover {
    transform: translateY(-2px);
}

.navbar-toggler {
    border: none;
    padding: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: #ffffff;
    transition: all 0.3s ease;
}

.navbar-toggler:hover {
    background: rgba(255, 255, 255, 0.2);
}

.navbar-nav {
    align-items: center;
    gap: 10px;
}

.nav-item {
    position: relative;
    margin: 0 5px;
}

.nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    font-size: 0.95rem;
    padding: 10px 20px !important;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-icon {
    font-size: 1.1rem;
}

.nav-link:hover, 
.nav-item.active .nav-link {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.1);
    padding: 5px 15px;
    border-radius: 30px;
    margin-left: 10px;
}

.uname {
    margin: 0;
    color: #ffffff;
    font-size: 0.95rem;
    font-weight: 500;
}

.userimg {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.8);
    object-fit: cover;
}

/* Enhanced Form Styles */
body {
    background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);
    padding-top: 80px;
}

.registration-form {
    padding: 50px 0;
}

.registration-form form {
    background-color: #ffffff;
    max-width: 600px;
    margin: auto;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.registration-form form:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.registration-form h1 {
    color: #2d3748;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 15px;
}

.registration-form h1:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: #4e73df;
    border-radius: 2px;
}

.form-icon {
    text-align: center;
    margin-bottom: 30px;
}

.form-icon img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #4e73df;
    padding: 3px;
    background: #ffffff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.form-icon img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.form-group {
    margin-bottom: 25px;
}

.formlabel {
    display: block;
    margin-bottom: 8px;
    color: #4a5568;
    font-weight: 500;
    font-size: 0.95rem;
}

.form-control.item {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    color: #2d3748;
}

.form-control.item:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
    outline: none;
}

.alert {
    border-radius: 12px;
    padding: 12px 20px;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.alert-danger {
    background-color: #fff5f5;
    border-color: #feb2b2;
    color: #c53030;
}

.alert-success {
    background-color: #f0fff4;
    border-color: #9ae6b4;
    color: #2f855a;
}

.btn.create-account {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    color: #ffffff;
    font-weight: 600;
    padding: 12px 30px;
    border-radius: 30px;
    font-size: 1rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(78, 115, 223, 0.2);
}

.btn.create-account:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(78, 115, 223, 0.3);
    background: linear-gradient(135deg, #224abe 0%, #4e73df 100%);
}

@media (max-width: 768px) {
    .registration-form form {
        padding: 30px 20px;
        margin: 15px;
    }

    .registration-form h1 {
        font-size: 1.8rem;
    }
    
    .navbar-collapse {
        background: rgba(78, 115, 223, 0.95);
        padding: 20px;
        border-radius: 12px;
        margin-top: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .nav-item {
        margin: 5px 0;
    }

    .user-profile {
        justify-content: center;
        margin: 10px 0;
    }
}

/* Footer Styles */
.footer_section {
    background: #2d3748;
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
}

.footer_section p {
    margin: 0;
    font-size: 0.9rem;
    opacity: 0.9;
}

.footer_section a {
    color: #4e73df;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer_section a:hover {
    color: #ffffff;
}
</style>