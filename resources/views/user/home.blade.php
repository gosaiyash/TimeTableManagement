<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Table Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
  <div class="container-lg">
    <a class="navbar-brand fw-bold" href="#"><i class="fas fa-calendar-alt me-2"></i>TTM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">

        <li class="nav-item">
          <a class="nav-link" href="/singup">Sign Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
      </ul>
      <a class="btn btn-outline-dark d-none d-lg-block" href="/adminlogin1">Admin</a>
    </div>
  </div>
</nav>

<section class="hero" id="hero">
  <div class="container-lg">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <h1 class="display-2 fw-bold">Time Table Management</h1>
        <p class="lead mb-4">Streamline your scheduling process with our comprehensive time table management system. Perfect for schools, universities, and organizations.</p>
        <div class="d-flex gap-3">
          <a href="/signup" class="btn btn-primary btn-lg">Get Started</a>
          <a href="#features" class="btn btn-outline-dark btn-lg">Learn More</a>
        </div>
      </div>
      <div class="col-sm-6 text-center">
        <img src="{{ asset('assets/img/ttbg1.png') }}" class="img-fluid hero-image" alt="Time Table Management System">
      </div>
    </div>
  </div>
</section>

<section class="features" id="features">
  <div class="container-lg">
    <h2 class="section-title text-center mb-5">Key Features</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card feature-card h-100">
          <div class="card-body text-center">
            <div class="feature-icon">
              <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="card-title">Smart Scheduling</h3>
            <p class="card-text">Automatically generate optimal schedules based on your requirements and constraints.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card feature-card h-100">
          <div class="card-body text-center">
            <div class="feature-icon">
              <i class="fas fa-users"></i>
            </div>
            <h3 class="card-title">Multi-User Support</h3>
            <p class="card-text">Manage different user roles with appropriate permissions for administrators, teachers, and students.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card feature-card h-100">
          <div class="card-body text-center">
            <div class="feature-icon">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <h3 class="card-title">Mobile Friendly</h3>
            <p class="card-text">Access your schedule from any device with our responsive design and mobile app.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="benefits" id="benefits">
  <div class="container-lg">
    <h2 class="section-title text-center mb-5">Benefits</h2>
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="{{ asset('assets/img/benefits.png') }}" class="img-fluid rounded shadow" alt="Benefits of TTM">
      </div>
      <div class="col-md-6">
        <div class="benefit-item mb-4">
          <div class="d-flex align-items-center">
            <div class="benefit-icon me-3">
              <i class="fas fa-clock"></i>
            </div>
            <div>
              <h4>Save Time</h4>
              <p>Reduce hours spent on manual scheduling with our automated system.</p>
            </div>
          </div>
        </div>
        <div class="benefit-item mb-4">
          <div class="d-flex align-items-center">
            <div class="benefit-icon me-3">
              <i class="fas fa-check-circle"></i>
            </div>
            <div>
              <h4>Eliminate Conflicts</h4>
              <p>Automatically detect and prevent scheduling conflicts between classes and resources.</p>
            </div>
          </div>
        </div>
        <div class="benefit-item mb-4">
          <div class="d-flex align-items-center">
            <div class="benefit-icon me-3">
              <i class="fas fa-chart-line"></i>
            </div>
            <div>
              <h4>Improve Efficiency</h4>
              <p>Optimize resource allocation and maximize classroom utilization.</p>
            </div>
          </div>
        </div>
        <div class="benefit-item">
          <div class="d-flex align-items-center">
            <div class="benefit-icon me-3">
              <i class="fas fa-bell"></i>
            </div>
            <div>
              <h4>Stay Notified</h4>
              <p>Receive alerts and notifications about schedule changes and updates.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="how-it-works" id="how-it-works">
  <div class="container-lg">
    <h2 class="section-title text-center mb-5">How It Works</h2>
    <div class="row">
      <div class="col-md-3">
        <div class="step-card text-center">
          <div class="step-number">1</div>
          <h4>Sign Up</h4>
          <p>Create your account and set up your organization profile.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="step-card text-center">
          <div class="step-number">2</div>
          <h4>Add Resources</h4>
          <p>Input your classrooms, teachers, subjects, and other resources.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="step-card text-center">
          <div class="step-number">3</div>
          <h4>Set Constraints</h4>
          <p>Define scheduling rules and preferences for your organization.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="step-card text-center">
          <div class="step-number">4</div>
          <h4>Generate Schedule</h4>
          <p>Let our system create the perfect schedule for you.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="testimonials">
  <div class="container-lg">
    <h2 class="section-title text-center mb-5">What Our Users Say</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-content">
            <p>"This system has completely transformed how we manage our school's schedule. It's intuitive and saves us countless hours."</p>
          </div>
          <div class="testimonial-author">
            <img src="{{ asset('assets/img/testimonial1.jpg') }}" alt="John Doe" class="rounded-circle">
            <div>
              <h5>John Doe</h5>
              <p>School Administrator</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-content">
            <p>"As a teacher, I love how easy it is to access my schedule and make changes when needed. The mobile app is a game-changer."</p>
          </div>
          <div class="testimonial-author">
            <img src="{{ asset('assets/img/testimonial2.jpg') }}" alt="Jane Smith" class="rounded-circle">
            <div>
              <h5>Jane Smith</h5>
              <p>University Professor</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="testimonial-card">
          <div class="testimonial-content">
            <p>"The conflict detection feature has eliminated scheduling errors that used to plague our department. Highly recommended!"</p>
          </div>
          <div class="testimonial-author">
            <img src="{{ asset('assets/img/testimonial3.jpg') }}" alt="Robert Johnson" class="rounded-circle">
            <div>
              <h5>Robert Johnson</h5>
              <p>Department Head</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta">
  <div class="container-lg text-center">
    <h2 class="mb-4">Ready to Transform Your Scheduling Process?</h2>
    <p class="lead mb-4">Join thousands of organizations that trust our time table management system.</p>
    <a href="/signup" class="btn btn-primary btn-lg">Get Started Today</a>
  </div>
</section>

<footer class="footer">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-4 mb-4 mb-md-0">
        <h5><i class="fas fa-calendar-alt me-2"></i>TTM</h5>
        <p>Streamline your scheduling process with our comprehensive time table management system.</p>
      </div>
      <div class="col-md-2 mb-4 mb-md-0">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#features">Features</a></li>
          <li><a href="#benefits">Benefits</a></li>
          <li><a href="#how-it-works">How It Works</a></li>
          <li><a href="/login">Login</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-4 mb-md-0">
        <h5>Contact Us</h5>
        <ul class="list-unstyled">
          <li><i class="fas fa-envelope me-2"></i> info@ttmsystem.com</li>
          <li><i class="fas fa-phone me-2"></i> +1 (123) 456-7890</li>
          <li><i class="fas fa-map-marker-alt me-2"></i> 123 Main St, City, Country</li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>Follow Us</h5>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <p>&copy; 2025 Time Table Management System. All Rights Reserved.</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<style>
:root {
  --primary-color: #4e73df;
  --secondary-color: #f5a841;
  --dark-color: #333;
  --light-color: #f8f9fa;
  --accent-color: #f5a841;
  --transition: all 0.3s ease;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: var(--dark-color);
  line-height: 1.6;
}

section [class^="container"] {
  padding: 5rem 2rem;
}

@media screen and (min-width: 1024px) {
  section [class^="container"] {
    padding: 5rem;
  }
  nav [class^="container"] {
    padding: 0 4rem;
  }
}

section:not(:first-of-type) {
  text-align: center;
}

section:nth-child(2n) {
  background-color: var(--light-color);
}

.container a {
  color: var(--dark-color);
  text-decoration: none;
  transition: var(--transition);
}

.container a:hover {
  color: var(--primary-color);
}

.section-title {
  position: relative;
  margin-bottom: 3rem;
  font-weight: 700;
}

.section-title:after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background-color: var(--primary-color);
}

/* NAVBAR */
.navbar {
  background-color: #ffffff;
  padding: 1rem 0;
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--primary-color);
}

.navbar-nav .nav-link {
  color: var(--dark-color);
  font-size: 1rem;
  font-weight: 500;
  transition: var(--transition);
  padding: 0.5rem 1rem;
}

.navbar-nav .nav-link:hover {
  color: var(--primary-color);
}

.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-primary:hover {
  background-color: #3a5ccc;
  border-color: #3a5ccc;
}

.btn-outline-dark {
  border: 2px solid var(--dark-color);
  box-shadow: 4px 4px var(--dark-color);
  transition: var(--transition);
}

.btn-outline-dark:hover {
  box-shadow: 4px 4px var(--accent-color);
  background-color: var(--dark-color);
  color: white;
}

/* HERO */
section.hero {
  padding-top: 120px;
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.hero h1 {
  margin-bottom: 1.5rem;
  color: var(--primary-color);
}

.hero-image {
  max-width: 90%;
  animation: float 6s ease-in-out infinite;
}

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

@media screen and (max-width: 576px) {
  section.hero {
    text-align: center;
    padding-top: 100px;
  }
  section.hero img {
    width: 80%;
    margin: 2rem 0;
  }
}

/* FEATURES */
.feature-card {
  border: none;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: var(--transition);
  overflow: hidden;
}

.feature-card:hover {
  transform: translateY(-10px);
}

.feature-icon {
  font-size: 2.5rem;
  margin: 1.5rem auto;
  color: var(--primary-color);
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(78, 115, 223, 0.1);
}

.feature-card h3 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

/* BENEFITS */
.benefit-item {
  margin-bottom: 2rem;
}

.benefit-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: rgba(78, 115, 223, 0.1);
  color: var(--primary-color);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
}

.benefit-item h4 {
  margin-bottom: 0.5rem;
  font-weight: 600;
}

/* HOW IT WORKS */
.step-card {
  padding: 2rem;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: var(--transition);
  height: 100%;
}

.step-card:hover {
  transform: translateY(-10px);
}

.step-number {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: var(--primary-color);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0 auto 1.5rem;
}

/* TESTIMONIALS */
.testimonial-card {
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  padding: 2rem;
  margin-bottom: 2rem;
  transition: var(--transition);
}

.testimonial-card:hover {
  transform: translateY(-10px);
}

.testimonial-content {
  margin-bottom: 1.5rem;
  font-style: italic;
}

.testimonial-author {
  display: flex;
  align-items: center;
}

.testimonial-author img {
  width: 50px;
  height: 50px;
  margin-right: 1rem;
  object-fit: cover;
}

.testimonial-author h5 {
  margin-bottom: 0;
  font-weight: 600;
}

.testimonial-author p {
  margin-bottom: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

/* CTA */
section.cta {
  background: linear-gradient(135deg, var(--primary-color) 0%, #3a5ccc 100%);
  color: white;
  padding: 5rem 0;
}

section.cta h2 {
  font-weight: 700;
}

section.cta .btn-primary {
  background-color: white;
  color: var(--primary-color);
  border: none;
  padding: 0.75rem 2rem;
  font-weight: 600;
}

section.cta .btn-primary:hover {
  background-color: rgba(255, 255, 255, 0.9);
}

/* FOOTER */
.footer {
  background-color: #2c3e50;
  color: white;
  padding: 5rem 0 2rem;
}

.footer h5 {
  font-weight: 600;
  margin-bottom: 1.5rem;
  position: relative;
  padding-bottom: 0.5rem;
}

.footer h5:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 50px;
  height: 2px;
  background-color: var(--primary-color);
}

.footer a {
  color: rgba(255, 255, 255, 0.7);
  transition: var(--transition);
}

.footer a:hover {
  color: white;
}

.social-icons {
  display: flex;
  gap: 1rem;
}

.social-icons a {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: var(--transition);
}

.social-icons a:hover {
  background-color: var(--primary-color);
  transform: translateY(-5px);
}

.footer hr {
  border-color: rgba(255, 255, 255, 0.1);
  margin: 3rem 0;
}
</style>
    
</body>
</html>