
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_update'])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['txt_address'];

    $upQry = "UPDATE tbl_user SET user_name = '" . $name . "', user_email = '" . $email . "', user_contact = '" . $contact . "', user_address = '" . $address . "' WHERE user_id = '" . $_SESSION['uid'] . "'";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Profile Updated Successfully");
            window.location = "Myprofile.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("UPDATION FAILED");
            window.location = "Editprofile.php";
        </script>
        <?php
    }
}

$selQry = "SELECT * FROM tbl_user WHERE user_id = '" . $_SESSION['uid'] . "'";
$row = $Con->query($selQry);
$data = $row->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>Edit Profile</title>
    <style>
        .profile-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .profile-form {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-form h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group label {
            font-weight: 500;
            color: #222;
        }
        .form-control, .form-control textarea {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .form-control textarea {
            resize: vertical;
            min-height: 100px;
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
        @media (max-width: 768px) {
            .profile-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="profile-section">
        <div class="container">
            <div class="profile-form">
                <h3>Edit Profile</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="txt_name">Name</label>
                        <input type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo htmlspecialchars($data['user_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="txt_email">Email</label>
                        <input type="email" name="txt_email" id="txt_email" class="form-control" value="<?php echo htmlspecialchars($data['user_email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="txt_contact">Contact</label>
                        <input type="tel" name="txt_contact" id="txt_contact" class="form-control" value="<?php echo htmlspecialchars($data['user_contact']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="txt_address">Address</label>
                        <textarea name="txt_address" id="txt_address" class="form-control" required rows="4"><?php echo htmlspecialchars($data['user_address']); ?></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_update" id="btn_update" class="primary-btn">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>
</body>
</html>
