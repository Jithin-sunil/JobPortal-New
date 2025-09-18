
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $date = $_POST['txt_date'];
    
    // Validate date
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        ?>
        <script>
            alert("Please select a future date");
            window.location = "Resubmission.php?tid=<?php echo $_GET['tid']; ?>";
        </script>
        <?php
    } else {
        $insQry = "UPDATE tbl_jobpost 
                   SET jobpost_resubmission = '" . $date . "' 
                   WHERE jobpost_id = '" . $_GET['tid'] . "' 
                   AND company_id = '" . $_SESSION['cid'] . "'";
        if ($Con->query($insQry)) {
            ?>
            <script>
                alert("Updated Successfully");
                window.location = "Jobpost.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Updation Failed");
                window.location = "Resubmission.php?tid=<?php echo $_GET['tid']; ?>";
            </script>
            <?php
        }
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
    <title>Extend Submission Date</title>


    <style>
        .resubmission-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .resubmission-form {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .resubmission-form h3 {
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
        @media (max-width: 768px) {
            .resubmission-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="resubmission-section">
        <div class="container">
            <div class="resubmission-form">
                <h3>Extend Submission Date</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="txt_date">New Submission Date</label>
                        <input type="date" name="txt_date" id="txt_date" class="form-control" 
                               min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>

</body>
</html>
