<!DOCTYPE html>
<html lang="en">
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
<div class="formdiv">
    <div>
         @if(Session::has('success'))
        <div class="alert alert-success" id="session2">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- header section strats -->
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
              <li class="nav-item active">
                <a class="nav-link" href="/">
                  <i class="fa fa-home nav-icon" aria-hidden="true"></i>
                  Home <span class="sr-only">(current)</span>
                </a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="/updatestudent">
                  <i class="fa fa-user-circle nav-icon" aria-hidden="true"></i>
                  Profile
                </a>
              </li>
              @if(Session::has('uid'))
                <li class="nav-item user-profile">
                  <h4 class="uname"> {{ Session::get('uname') }} </h4>
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
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail-box">
                    <h1>
                      Time Table <br>
                      Management
                    </h1>
                    <p>
                    Time management in college involves organizing schedules, balancing classes, studying, and activities. Prioritize tasks, set goals, and create a daily plan to stay on track and reduce stress. 📚🕒 </p>
                   
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail-box">
                  <h1>
                      Time Table <br>
                      Management
                    </h1>
                    <p>
                    Time management in college involves organizing schedules, balancing classes, studying, and activities. Prioritize tasks, set goals, and create a daily plan to stay on track and reduce stress. 📚🕒 </p>
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="detail-box">
                  <h1>
                      Time Table <br>
                      Management
                    </h1>
                    <p>
                    Time management in college involves organizing schedules, balancing classes, studying, and activities. Prioritize tasks, set goals, and create a daily plan to stay on track and reduce stress. 📚🕒 </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>

    </section>
    <!-- end slider section -->
  </div>

 
  <div class="card-container">
  @foreach ($documents as $doc)
    <div class="pdf-card">
      <div class="pdf-header">📅 Date: {{ $doc->date }}</div>
      <div class="pdf-meta">Semester {{ $doc->sem }}</div>
      <div class="pdf-description">{{ $doc->description }}</div>

      <iframe class="pdf-preview" src="{{ $doc->path }}#toolbar=0&navpanes=0" type="application/pdf"></iframe>

      <a href="{{ $doc->path }}" download class="btn-download">Download PDF</a>
    </div>
  @endforeach
</div>


  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="service_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Our <span>Services</span>
          </h2>
          <p>
          Our timetable management service ensures organized schedules, smooth operations, and improved productivity. Your success, simplified. 📅✅
           </p>
        </div>
      
        
        <div class="box1">
          @foreach($service as $row)
          <div class="box ">
              <div class="img-box">
                <img src="{{ $row->image }}" alt="">
              </div>
                <div class="detail-box">
                  <h5>
                    {{ $row->s_name }}
                  </h5>
                  <p>
                  {{ $row->description }}
                  </p>
                  <a href="">
                   TTM
                  </a>
                </div>
            </div>
            @endforeach
            </div>
        
      </div>
    </div>
  </section>

  <!-- info section -->

  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_contact">
            <h4>
              Address
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Ahmedabad,Ljku
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +91 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  ttm_help@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_detail">
            <h4>
              Info
            </h4>
            <p>
            Our timetable management service ensures organized schedules, smooth operations, and improved productivity. Your success, simplified. 📅✅
        </p>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3 info_col ">
          <h4>
            Help
          </h4>
          <form action="#">
            <input type="text" placeholder="Enter email" />
            <button type="submit">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->

  <!-- footer section -->
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

  <script>
  window.addEventListener('scroll', function() {
      const header = document.querySelector('.header_section');
      if (window.scrollY > 50) {
          header.classList.add('scrolled');
      } else {
          header.classList.remove('scrolled');
      }
  });
  </script>

</body>

</html>
<style>
  .box1{
    display:flex;
    flex-direction:row;
  }
  .box{
    display:flex;
    flex-direction:row;
  
    width:30vw;
  }
.userimg
{
 width:55px;
 height:53px;
 border-radius:60px;
 margin-top:-6px;
 padding-top:-5px;
 border:2px solid white;
 
}
.uname
{
  margin-top:4px; 
  margin-right:8px;
  color:white;
  font-family:bold;
}
a
{
  margin-top:3px;
}


    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
    }

    .pdf-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      padding: 20px;
      width: 360px;
      transition: transform 0.3s ease;
    }

    .pdf-card:hover {
      transform: translateY(-5px);
    }

    .pdf-header {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      color: #2c3e50;
    }

    .pdf-meta {
      font-size: 14px;
      color: #6c757d;
      margin-bottom: 8px;
    }

    .pdf-description {
      font-size: 15px;
      color: #444;
      margin-bottom: 15px;
    }

    .pdf-preview {
      width: 100%;
      height: 200px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .btn-download {
      display: inline-block;
      text-align: center;
      padding: 10px 16px;
      background: linear-gradient(to right, #1e88e5, #5e35b1);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-download:hover {
      background: linear-gradient(to right, #ffee58, #66bb6a);
      color: #222;
    }

.hero_area {
    position: relative;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.hero_bg_box {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

.bg_img_box {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    animation: scale 20s infinite alternate;
}

.bg_img_box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.1;
}

/* Modern Navigation Styles */
.header_section {
    padding: 15px 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.header_section.scrolled {
    background: rgba(78, 115, 223, 0.95);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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

.login-link {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 8px 24px !important;
}

.login-link:hover {
    background: #ffffff;
    color: #4e73df !important;
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

@media (max-width: 991px) {
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

/* Slider Section */
.slider_section {
    flex: 1;
    display: flex;
    align-items: center;
    position: relative;
    z-index: 1;
    padding: 60px 0;
}

.detail-box h1 {
    font-size: 3.5rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 20px;
    line-height: 1.2;
}

.detail-box p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 30px;
}

.img-box img {
    width: 100%;
    max-width: 500px;
    animation: float 6s ease-in-out infinite;
}

/* Service Section */
.service_section {
    padding: 80px 0;
    background: #f8fafc;
}

.heading_container {
    margin-bottom: 50px;
}

.heading_container h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    position: relative;
    padding-bottom: 15px;
}

.heading_container h2 span {
    color: #4e73df;
}

.heading_container h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: #4e73df;
}

.box1 {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.box {
    flex: 0 1 calc(33.333% - 30px);
    background: #ffffff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.box:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.box .img-box {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-bottom: 20px;
    overflow: hidden;
}

.box .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.box h5 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 15px;
}

.box p {
    color: #718096;
    line-height: 1.7;
    margin-bottom: 20px;
}

/* Info Section */
.info_section {
    background: #2d3748;
    color: #ffffff;
    padding: 80px 0;
}

.info_contact h4,
.info_detail h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 25px;
    color: #ffffff;
}

.contact_link_box a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.contact_link_box a:hover {
    color: #ffffff;
    transform: translateX(5px);
}

.contact_link_box i {
    margin-right: 10px;
    width: 25px;
}

.info_social {
    margin-top: 30px;
}

.info_social a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.info_social a:hover {
    background: #4e73df;
    transform: translateY(-5px);
}

/* Animations */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0px);
    }
}

@keyframes scale {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.1);
    }
}

/* Responsive Styles */
@media (max-width: 991px) {
    .box {
        flex: 0 1 calc(50% - 30px);
    }
    
    .detail-box h1 {
        font-size: 2.8rem;
    }
}

@media (max-width: 768px) {
    .box {
        flex: 0 1 100%;
    }
    
    .detail-box h1 {
        font-size: 2.2rem;
    }
    
    .header_section {
        padding: 10px 0;
    }
    
    .navbar-brand {
        font-size: 1.5rem;
    }
}

/* Card Container Enhanced Styles */
.card-container {
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);
}

.pdf-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    padding: 25px;
    width: 380px;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.pdf-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.pdf-header {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.pdf-meta {
    font-size: 0.95rem;
    color: #4e73df;
    font-weight: 600;
    margin-bottom: 12px;
    padding: 6px 12px;
    background: rgba(78, 115, 223, 0.1);
    border-radius: 20px;
    display: inline-block;
}

.pdf-description {
    font-size: 1rem;
    color: #718096;
    line-height: 1.6;
    margin-bottom: 20px;
}

.pdf-preview {
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    margin-bottom: 20px;
}

.btn-download {
    background: #4e73df;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 6px rgba(78, 115, 223, 0.2);
}

.btn-download:hover {
    background: #3a5ccc;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(78, 115, 223, 0.3);
    color: #ffffff;
    text-decoration: none;
}

</style>
