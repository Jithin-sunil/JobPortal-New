<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
    $address=$_POST['txt_address'];
	
	$licnum=$_POST['txt_idnumber'];
	
	$logo=$_FILES['file_logo']['name'];
	$templogo=$_FILES['file_logo']['tmp_name'];
	move_uploaded_file($templogo,'../Assets/Files/Company_Registration/Logo/'.$logo);
	
	$license=$_FILES['file_license']['name'];
	$templicense=$_FILES['file_license']['tmp_name'];
	move_uploaded_file($templicense,'../Assets/Files/Company_Registration/License/'.$license);
	
	$password=$_POST['txt_password'];
	$companycategory=$_POST['sel_companycategory'];
	$place=$_POST['sel_place'];
	$companytype=$_POST['sel_companytype'];
	
     $insQry = "insert into tbl_company(company_name, company_email,company_contact, company_address, company_logo, company_license, place_id,companytype_id, companycategory_id, company_password,company_licensenumber) values('".$name."','".$email."','".$contact."','".$address."','".$logo."','".$license."','".$place."','".$companytype."','".$companycategory."','".$password."','".$licnum."')";
	if($Con->query($insQry))
	{
		?>
		<script>
		alert("Insertion Successfully");
		window.location="Company.php";
		</script>
		
	   <?php	
	}
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="Company.php";
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
    <meta name="description" content="Company Registration Page">
    <!-- Meta Keyword -->
    <meta name="keywords" content="job listing, company registration">
    <!-- Meta Character Set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Company Registration</title>

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
            min-height: 600px;
            display: flex;
            align-items: stretch;
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
                                <li class="menu-active"><a href="Company.php">Company Registration</a></li>
                                <li><a href="UserRegistration.php">User Registration</a></li>
                            </ul>
                        </li>
                        <li><a href="Login.php">Login</a></li>
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
                    <h1 class="text-white">Register Your <span>Company</span></h1>
                    <p class="text-white">Join our platform to connect with top talent and grow your business.</p>
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
                    <lottie-player src="https://lottie.host/de62bc79-3005-4af0-a081-7892f3f29b05/oTSHETXZsJ.json" background="transparent" speed="1" style="width: 100%; max-width: 500px; height: auto;" loop autoplay></lottie-player>
                </div>
                <div class="col-lg-6">
                    <div class="form-section">
                        <h3>Company Registration</h3>
                        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="form-group">
                                <label for="txt_name">Company Name</label>
                                <input type="text" class="form-control" name="txt_name" id="txt_name" minlength="3" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_address">Address</label>
                                <textarea class="form-control" name="txt_address" id="txt_address" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="sel_companycategory">Company Category</label>
                                <select class="form-control" name="sel_companycategory" id="sel_companycategory" required>
                                    <option>- Select Company Category -</option>
                                    <?php
                                    include("../Assets/Connection/Connection.php");
                                    $selQry = "select * from tbl_companycategory where companycategory_status=0 ORDER BY companycategory_name ASC";
                                    $row = $Con->query($selQry);
                                    while ($data = $row->fetch_assoc()) {
                                        echo "<option value='{$data['companycategory_id']}'>{$data['companycategory_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txt_email">Email</label>
                                <input type="email" class="form-control" name="txt_email" id="txt_email" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_contact">Contact</label>
                                <input type="text" class="form-control" name="txt_contact" id="txt_contact" maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaining 9 digits with 0-9" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_idnumber">License Number</label>
                                <input type="text" class="form-control" name="txt_idnumber" id="txt_idnumber" required>
                                <label for="file_license">Upload License (PDF)</label>
                                <input type="file" class="form-control" name="file_license" id="file_license" accept="application/pdf" required>
                            </div>
                            <div class="form-group">
                                <label for="sel_state">State</label>
                                <select class="form-control" name="sel_state" id="sel_state" onchange="getDistrict(this.value)" required>
                                    <option>- Select State -</option>
                                    <?php
                                    $selQry = "select * from tbl_state where state_status=0 ORDER BY state_name ASC";
                                    $row = $Con->query($selQry);
                                    while ($data = $row->fetch_assoc()) {
                                        echo "<option value='{$data['state_id']}'>{$data['state_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel_district">District</label>
                                <select class="form-control" name="sel_district" id="sel_district" onchange="getPlace(this.value)" required>
                                    <option>- Select District -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel_place">Place</label>
                                <select class="form-control" name="sel_place" id="sel_place" required>
                                    <option>- Select Place -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file_logo">Logo</label>
                                <input type="file" class="form-control" name="file_logo" id="file_logo" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="sel_companytype">Company Type</label>
                                <select class="form-control" name="sel_companytype" id="sel_companytype" required>
                                    <option>- Select Company Type -</option>
                                    <?php
                                    $selQry = "select * from tbl_companytype where companytype_status=0 ORDER BY companytype_name ASC";
                                    $row = $Con->query($selQry);
                                    while ($data = $row->fetch_assoc()) {
                                        echo "<option value='{$data['companytype_id']}'>{$data['companytype_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txt_password">Password</label>
                                <input type="password" class="form-control" name="txt_password" id="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                            </div>
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
    <!-- AJAX Script -->
    <script>
        function getDistrict(sid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
                success: function(result) {
                    $("#sel_district").html(result);
                }
            });
        }

        function getPlace(pid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?pid=" + pid,
                success: function(result) {
                    $("#sel_place").html(result);
                }
            });
        }
    </script>
</body>
</html>