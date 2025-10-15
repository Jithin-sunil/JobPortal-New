<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal - Find Your Dream Career</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    /* Navbar */
    .navbar {
      background: #2a5298;
      padding: 15px 0;
    }

    .navbar-brand {
      font-size: 28px;
      font-weight: 700;
      color: #fff !important;
    }

    .navbar-brand span {
      color: #ff4d4d;
    }

    .nav-link {
      color: #fff !important;
      font-weight: 500;
      margin-left: 15px;
    }

    .nav-link:hover {
      color: #ffcc00 !important;
    }

    /* Hero Section */
    .hero {
      background: url("https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1500&q=80") no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      position: relative;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.6);
    }

    .hero-content {
      position: relative;
      z-index: 1;
    }

    .hero h1 {
      font-size: 50px;
      font-weight: 700;
    }

    .hero p {
      font-size: 18px;
      margin: 20px 0;
    }

    .btn-custom {
      padding: 12px 25px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 30px;
      transition: 0.3s;
    }

    .btn-primary-custom {
      background: #ff4d4d;
      color: #fff;
      border: none;
    }

    .btn-primary-custom:hover {
      background: #ff1a1a;
    }

    .btn-outline-custom {
      border: 2px solid #fff;
      color: #fff;
    }

    .btn-outline-custom:hover {
      background: #fff;
      color: #000;
    }
    /* Hero Search Bar */
.hero-search-form {
  max-width: 700px;
  width: 90%;
  margin: 0 auto;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  border-radius: 50px;
  overflow: hidden;
  background: #fff;
}

.hero-search-input {
  border: none;
  padding: 15px 20px;
  border-radius: 50px 0 0 50px;
  flex: 1;
  font-size: 16px;
}

.hero-search-input:focus {
  outline: none;
  box-shadow: none;
}

.hero-search-btn {
  background: #ff4d4d;
  color: #fff;
  border: none;
  padding: 15px 30px;
  font-weight: 600;
  border-radius: 0 50px 50px 0;
  transition: background 0.3s;
}

.hero-search-btn:hover {
  background: #ff1a1a;
}


    /* Categories */
    .categories {
      padding: 80px 0;
      text-align: center;
    }

    .categories h2 {
      font-weight: 700;
      margin-bottom: 50px;
    }

    .category-card {
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }

    .category-card:hover {
      transform: translateY(-8px);
    }

    .category-card i {
      font-size: 35px;
      color: #2a5298;
      margin-bottom: 15px;
    }

    /* Call to Action */
    .cta {
      background: linear-gradient(to right, #2a5298, #1e3c72);
      color: #fff;
      padding: 70px 0;
      text-align: center;
    }

    .cta h2 {
      font-weight: 700;
      margin-bottom: 20px;
    }

    /* Footer */
    footer {
      background: #111;
      color: #aaa;
      padding: 40px 0;
    }

    footer a {
      color: #fff;
      text-decoration: none;
    }

    footer a:hover {
      color: #ff4d4d;
    }

    .social-icons a {
      color: #fff;
      margin: 0 10px;
      font-size: 20px;
    }
  </style>
</head>

<body>

 <!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php"><span>Job</span>Portal</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <!-- Home -->
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>

        <!-- Sign Up Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="signupDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sign Up
          </a>
          <ul class="dropdown-menu" aria-labelledby="signupDropdown">
            <li><a class="dropdown-item" href="Guest/Company.php">Company Registration</a></li>
            <li><a class="dropdown-item" href="Guest/UserRegistration.php">User Registration</a></li>
          </ul>
        </li>

        

        <!-- Login -->
        <li class="nav-item"><a class="nav-link" href="Guest/Login.php">Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Find Your Dream Job Today</h1>
      <p>Discover opportunities, showcase your skills, and take the first step towards your career goals.</p>
      <a href="#" class="btn btn-custom btn-primary-custom me-3">Get Started</a>
      <a href="#" class="btn btn-custom btn-outline-custom">Learn More</a>
    </div>
  </section>


  <!-- Categories -->
  <section class="categories">
    <div class="container">
      <h2>Featured Job Categories</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="category-card">
            <i class="fas fa-laptop-code"></i>
            <h5>Development</h5>
            <p>Explore software, web, and app development opportunities.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="category-card">
            <i class="fas fa-briefcase"></i>
            <h5>Business</h5>
            <p>Find jobs in management, finance, and consulting fields.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="category-card">
            <i class="fas fa-stethoscope"></i>
            <h5>Healthcare</h5>
            <p>Join careers in medical, nursing, and health sciences.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="container">
      <h2>Join Us Today Without Any Hesitation</h2>
      <p>Start your journey today and unlock countless opportunities in your field.</p>
      <a href="#" class="btn btn-custom btn-primary-custom">Sign Up</a>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <p>&copy; 2025 JobPortal. All rights reserved.</p>
      <div class="social-icons mt-3">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
