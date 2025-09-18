<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $appli = $_FILES["txt_file"]['name'];
    $tempappli = $_FILES['txt_file']['tmp_name'];
    move_uploaded_file($tempappli, '../Assets/Files/User_Application/Application/' . $appli);

    $insQry = "insert into tbl_application(application_date, application_file, user_id, jobpost_id) values(curdate(),'" . $appli . "','" . $_SESSION['uid'] . "','" . $_GET['eid'] . "')";
    if ($Con->query($insQry)) {
        ?>
        <script>
            alert("Submitted Successfully");
            window.location = "MyApplication.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Wrong submission");
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
    <title>Job Application</title>


    <style>
        .application-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .application-form {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .application-form h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group label {
            font-weight: 500;
            color: #222;
        }
        .form-control-file {
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
    </style>
</head>
<body>
    <section class="application-section">
        <div class="container">
            <div class="application-form">
                <h3>Job Application</h3>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="form-group">
                        <label for="txt_file">Upload Application File (PDF)</label>
                        <input type="file" name="txt_file" id="txt_file" class="form-control form-control-file" accept="application/pdf" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Apply Now</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>
</body>
</html>