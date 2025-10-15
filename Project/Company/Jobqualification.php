
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $jobqualification = $_POST['sel_qualification'];
    
    $selQry = "SELECT * FROM tbl_jobqualification 
               WHERE qualification_id = '" . $jobqualification . "' 
               AND jobpost_id = '" . $_GET['pid'] . "' 
               AND jobqualification_status = 0";
    $exist = $Con->query($selQry);
    if ($existdata = $exist->fetch_assoc()) {
        ?>
        <script>
            alert("Qualification Already Exists");
            window.location = "Jobqualification.php?pid=<?php echo $_GET['pid']; ?>";
        </script>
        <?php
    } else {
        $insQry = "INSERT INTO tbl_jobqualification(qualification_id, jobpost_id) 
                   VALUES ('" . $jobqualification . "', '" . $_GET['pid'] . "')";
        if ($Con->query($insQry)) {
            ?>
            <script>
                alert("Insertion Successfully");
                window.location = "Jobqualification.php?pid=<?php echo $_GET['pid']; ?>";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Insertion Failed");
                window.location = "Jobqualification.php?pid=<?php echo $_GET['pid']; ?>";
            </script>
            <?php
        }
    }
}

// Remove
if (isset($_GET['rid'])) {
    $upQry = "UPDATE tbl_jobqualification SET jobqualification_status = 1 
              WHERE jobqualification_id = '" . $_GET['rid'] . "' 
              AND jobpost_id = '" . $_GET['pid'] . "'";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Removed");
            window.location = "Jobqualification.php?pid=<?php echo $_GET['pid']; ?>";
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
    <title>Job Qualification</title>


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
            color: #222;
        }
        .form-group label {
            font-weight: 500;
            color: #222;
        }
        .form-control, .form-control select {
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
            color: #555;
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
        }
    </style>
</head>
<body>
    <section class="qualification-section">
        <div class="container">
            <div class="qualification-form">
                <h3>Add Job Qualification</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="sel_qualification"></label>
                        <select name="sel_qualification" id="sel_qualification" class="form-control" required>
                            <option value="">-- Select Qualification --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_qualification WHERE qualification_status = 0 ORDER BY qualification_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['qualification_id']; ?>">
                                <?php echo htmlspecialchars($data['qualification_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="qualification-table">
                <h3>Job Qualification List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Qualification</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_jobqualification j 
                                   INNER JOIN tbl_qualification q ON j.qualification_id = q.qualification_id 
                                   WHERE j.jobqualification_status = 0 AND j.jobpost_id = '" . $_GET['pid'] . "'";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['qualification_name']); ?></td>
                            <td>
                                <a href="Jobqualification.php?rid=<?php echo $data['jobqualification_id']; ?>&pid=<?php echo $data['jobpost_id']; ?>" 
                                   class="action-link" 
                                   onclick="return confirm('Are you sure you want to remove this qualification?');">Remove</a>
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
