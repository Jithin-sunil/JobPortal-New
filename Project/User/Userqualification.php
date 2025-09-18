
<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

if (isset($_POST["btn_submit"])) {
    $qualification_id = $_POST["sel_qualification"];
    $certificate = $_FILES["file_certificate"]['name'];
    $tempcertificate = $_FILES['file_certificate']['tmp_name'];
    move_uploaded_file($tempcertificate, '../Assets/Files/User_Qualification/Certificate/' . $certificate);

    $insQry = "INSERT INTO tbl_userqualification(qualification_id, userqualification_certificate, user_id) 
               VALUES ('" . $qualification_id . "', '" . $certificate . "', '" . $_SESSION['uid'] . "')";
    if ($Con->query($insQry)) {
        ?>
        <script>
            alert("Submitted Successfully");
            window.location = "Userqualification.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Wrong submission");
            window.location = "Userqualification.php";
        </script>
        <?php
    }
}

# Remove
if (isset($_GET['rid'])) {
    $remQry = "UPDATE tbl_userqualification SET userqualification_status = 1 WHERE userqualification_id = '" . $_GET['rid'] . "'";
    if ($Con->query($remQry)) {
        ?>
        <script>
            alert("Removal Successfully");
            window.location = "Userqualification.php";
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
    <title>My Qualifications</title>
    <style>
        .qualification-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .qualification-form, .qualification-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .qualification-form h3, .qualification-table h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group label {
            font-weight: 500;
            color: #222;
        }
        .form-control, .form-control select, .form-control-file {
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
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background: #f44a40;
            color: #fff;
            font-weight: 600;
        }
        .table td {
            background: #fff;
        }
        .certificate-img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .action-link {
            color: #f44a40;
            text-decoration: none;
            font-weight: 500;
        }
        .action-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .qualification-form, .qualification-table {
                padding: 20px;
            }
            .table th, .table td {
                padding: 10px;
                font-size: 14px;
            }
            .certificate-img {
                max-width: 80px;
            }
        }
    </style>
</head>
<body>
    <section class="qualification-section">
        <div class="container">
            <div class="qualification-form">
                <h3>Add Qualification</h3>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="form-group">
                        <label for="sel_qualification">Qualification</label>
                        <select name="sel_qualification" id="sel_qualification" class="form-control" required>
                            <option value="">-- Select Qualification --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_qualification WHERE qualification_status = 0";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['qualification_id']; ?>">
                                <?php echo htmlspecialchars($data['qualification_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file_certificate">Certificate</label>
                        <input type="file" name="file_certificate" id="file_certificate" class="form-control-file" accept="image/*,application/pdf" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="qualification-table">
                <h3>My Qualifications</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Qualification</th>
                            <th>Certificate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_userqualification u
                                   INNER JOIN tbl_qualification q ON u.qualification_id = q.qualification_id  
                                   WHERE userqualification_status = 0 AND user_id = '" . $_SESSION['uid'] . "'";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['qualification_name']); ?></td>
                            <td>
                                <img src="../Assets/Files/User_Qualification/Certificate/<?php echo htmlspecialchars($data['userqualification_certificate']); ?>" class="certificate-img" alt="Certificate">
                            </td>
                            <td>
                                <a href="Userqualification.php?rid=<?php echo $data['userqualification_id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to remove this qualification?')">Remove</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>

</body>
</html>
