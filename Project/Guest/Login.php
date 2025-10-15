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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            overflow: hidden; /* 🚫 No scrolling */
        }
        body {
            background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f') no-repeat center center/cover;
            position: relative;
        }
        .overlay-bg {
            background: rgba(0,0,0,0.65);
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
        }
        .login-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .form-container {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 40px;
            display: flex;
            width: 900px;
            max-width: 95%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .form-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
        }
        .form-section h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        .primary-btn {
            background: linear-gradient(45deg, #ff4d4d, #ff7a7a);
            border: none;
            padding: 12px;
            color: #fff;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .primary-btn:hover {
            background: linear-gradient(45deg, #d43c3c, #f74d4d);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,77,77,0.4);
        }
        .lottie-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        @media (max-width: 991px) {
            .form-container {
                flex-direction: column;
                text-align: center;
                height: auto;
            }
            .lottie-container {
                max-height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay-bg"></div>
    <div class="login-wrapper">
        <div class="form-container">
            <div class="lottie-container">
                <lottie-player src="https://lottie.host/f6290d77-4e92-4663-919a-862786c810fb/GEq9UrXEgf.json" 
                               background="transparent" 
                               speed="1" 
                               style="width: 100%; max-width: 350px;" 
                               loop autoplay>
                </lottie-player>
            </div>
            <div class="form-section">
                <h3>Login</h3>
                <form action="" method="post">
                    <input type="email" class="form-control" name="txt_email" placeholder="Enter Your Email" required>
                    <input type="password" class="form-control" name="txt_password" placeholder="Enter Your Password" required>
                    <button type="submit" name="btn_login" class="primary-btn">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Lottie -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
