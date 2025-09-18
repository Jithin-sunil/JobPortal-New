
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_changepass'])) {
    $oldpass = $_POST['txt_opass'];
    $newpass = $_POST['txt_opass2'];
    $retypepass = $_POST['txt_retypepass'];

    $selQry = "SELECT * FROM tbl_user WHERE user_id = '" . $_SESSION['uid'] . "'";
    $row = $Con->query($selQry);
    $data = $row->fetch_assoc();

    $currentpass = $data['user_password'];

    if ($oldpass == $currentpass) {
        if ($newpass == $retypepass) {
            $upQry = "UPDATE tbl_user SET user_password = '" . $newpass . "' WHERE user_id = '" . $_SESSION['uid'] . "'";
            if ($Con->query($upQry)) {
                ?>
                <script>
                    alert("Password updated");
                    window.location = "../Guest/Login.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Password update failed");
                    window.location = "Changepass.php";
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("New password and re-typed password do not match");
                window.location = "Changepass.php";
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Invalid old password");
            window.location = "Changepass.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>Change Password</title>


    <style>
        .password-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .password-form {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .password-form h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #222;
        }
        .form-group label {
            font-weight: 500;
            color: #222;
        }
        .form-control {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .primary-btn {
            background: #f44a40;
            border: none;
            padding: 12px 30px;
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .primary-btn:hover {
            background: #e33a30;
        }
        .cancel-btn {
            background: #6c757d;
            border: none;
            padding: 12px 30px;
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .cancel-btn:hover {
            background: #5a6268;
        }
        .password-toggle {
            cursor: pointer;
            color: #f44a40;
            font-size: 14px;
            margin-left: 10px;
        }
        .password-toggle:hover {
            color: #e33a30;
        }
        @media (max-width: 768px) {
            .password-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="password-section">
        <div class="container">
            <div class="password-form">
                <h3>Change Password</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="txt_opass">Old Password</label>
                        <div class="d-flex align-items-center">
                            <input type="password" name="txt_opass" id="txt_opass" class="form-control" 
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                                   required>
                            <span class="password-toggle" onclick="togglePassword('txt_opass')">Show</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_opass2">New Password</label>
                        <div class="d-flex align-items-center">
                            <input type="password" name="txt_opass2" id="txt_opass2" class="form-control" 
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                                   required>
                            <span class="password-toggle" onclick="togglePassword('txt_opass2')">Show</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_retypepass">Re-Type Password</label>
                        <div class="d-flex align-items-center">
                            <input type="password" name="txt_retypepass" id="txt_retypepass" class="form-control" 
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" 
                                   required>
                            <span class="password-toggle" onclick="togglePassword('txt_retypepass')">Show</span>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_changepass" id="btn_changepass" class="primary-btn">Change Password</button>
                        <button type="reset" name="btn_cancel" id="btn_cancel" class="cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>

    <script>
        function togglePassword(inputId) {
            var input = document.getElementById(inputId);
            var toggle = input.nextElementSibling;
            if (input.type === "password") {
                input.type = "text";
                toggle.textContent = "Hide";
            } else {
                input.type = "password";
                toggle.textContent = "Show";
            }
        }
    </script>
</body>
</html>
