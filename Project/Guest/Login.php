<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_login']))
{
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];
    
    // User
    $selUser = "select * from tbl_user where user_email='$email' and user_password='$password'";
    $rowUser = $Con->query($selUser);
    
    // Admin
    $selAdmin = "select * from tbl_admin where admin_email='$email' and admin_password='$password'";
    $rowAdmin = $Con->query($selAdmin);
    
    // Company
    $selComp = "select * from tbl_company where company_email='$email' and company_password='$password'";
    $rowComp = $Con->query($selComp);
    
    if($dataUser = $rowUser->fetch_assoc())
    {
        $_SESSION['uid'] = $dataUser['user_id'];
        $_SESSION['uname'] = $dataUser['user_name'];
        header("location:../User/Homepage.php");
    }
    else if($dataAdmin = $rowAdmin->fetch_assoc())
    {
        $_SESSION['aid'] = $dataAdmin['admin_id'];
        $_SESSION['aname'] = $dataAdmin['admin_name'];
        header("location:../Admin/Homepage.php");
    }
    else if($dataComp = $rowComp->fetch_assoc())
    {
        if($dataComp['company_status'] == 0)
        {
            ?>
            <script>
                alert("Verification Pending");
                window.location = "Login.php";
            </script>
            <?php
        }
        else if($dataComp['company_status'] == 2)
        {
            ?>
            <script>
                alert("Check your company has verified");
                window.location = "Login.php";
            </script>
            <?php
        }
        else
        {
            $_SESSION['cid'] = $dataComp['company_id'];
            $_SESSION['cname'] = $dataComp['company_name'];
            header("location:../Company/Homepage.php");
        }
    }
    else
    {
        ?>
        <script>
            alert("Login Failed");
            window.location = "Login.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../Assets/Templates/Main/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="Login Page">
    <!-- Meta Keyword -->
    <meta name="keywords" content="job listing, login">
    <!-- Meta Character Set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Login</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/linearicons.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/magnific-popup.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/nice-select.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/animate.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/owl.carousel.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/main.css">
    <!-- Custom CSS -->
    <style>
        .form-section {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin: 50px 0;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-section h3 {
            color: #222;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .form-group label {
            font-weight: 500;
            color: #333;
        }
        .primary-btn {
            background: #f74d4d;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
        }
        .primary-btn:hover {
            background: #d43c3c;
        }
        .lottie-container {
            max-width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .form-container {
            min-height: 500px;
            display: flex;
            align-items: stretch;
        }
        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }
        .forgot-password a {
            color: #f74d4d;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        @media (max-width: 991px) {
            .form-container {
                flex-direction: column;
            }
            .lottie-container {
                max-height: 400px;
            }
            .form-section {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="../index.html"><img src="../Assets/Templates/Main/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li class="menu-has-children"><a href="">Sign Up</a>
                            <ul>
                                <li><a href="Company.php">Company Registration</a></li>
                                <li><a href="UserRegistration.php">User Registration</a></li>
                            </ul>
                        </li>
                        <li class="menu-active"><a href="Login.php">Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Start Banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content col-lg-12">
                    <h1 class="text-white">Login to Your <span>Account</span></h1>
                    <p class="text-white">Access your account to explore job opportunities or manage your company.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Form Area -->
    <section class="section-gap">
        <div class="container">
            <div class="row form-container">
                <div class="col-lg-6 lottie-container">
                    <lottie-player src="https://lottie.host/f6290d77-4e92-4663-919a-862786c810fb/GEq9UrXEgf.json" background="transparent" speed="1" style="width: 100%; max-width: 500px; height: auto;" loop autoplay></lottie-player>
                </div>
                <div class="col-lg-6">
                    <div class="form-section">
                        <h3>Login</h3>
                        <form action="" method="post" name="form1" id="form1">
                            <div class="form-group">
                                <label for="txt_email">Email</label>
                                <input type="email" class="form-control" name="txt_email" id="txt_email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_password">Password</label>
                                <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter Your Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_login" id="btn_login" class="primary-btn">Login</button>
                            </div>
                            <!-- <div class="forgot-password">
                                <a href="#">Forgot Password?</a>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Form Area -->

    <!-- Start Footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="single-footer-widget">
                        <h6>Top Products</h6>
                        <ul class="footer-nav">
                            <li><a href="#">Managed Website</a></li>
                            <li><a href="#">Manage Reputation</a></li>
                            <li><a href="#">Power Tools</a></li>
                            <li><a href="#">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="single-footer-widget newsletter">
                        <h6>Newsletter</h6>
                        <p>You can trust us. we only send promo offers, not a single spam.</p>
                        <div id="mc_embed_signup">
                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                                <div class="form-group row" style="width: 100%">
                                    <div class="col-lg-8 col-md-12">
                                        <input name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required type="email">
                                        <div style="position: absolute; left: -5000px;">
                                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <button class="nw-btn primary-btn">Subscribe<span class="lnr lnr-arrow-right"></span></button>
                                    </div>
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Area -->

    <!-- Scripts -->
    <script src="../Assets/Templates/Main/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../Assets/Templates/Main/js/vendor/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Main/js/easing.min.js"></script>
    <script src="../Assets/Templates/Main/js/hoverIntent.js"></script>
    <script src="../Assets/Templates/Main/js/superfish.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.ajaxchimp.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.magnific-popup.min.js"></script>
    <script src="../Assets/Templates/Main/js/owl.carousel.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.sticky.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.nice-select.min.js"></script>
    <script src="../Assets/Templates/Main/js/parallax.min.js"></script>
    <script src="../Assets/Templates/Main/js/mail-script.js"></script>
    <script src="../Assets/Templates/Main/js/main.js"></script>
    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>