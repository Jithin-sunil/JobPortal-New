
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $jobtechnicalskill = $_POST['sel_techskill'];
    
    // Check for duplicate skill
    $selQry = "SELECT * FROM tbl_jobtechnicalskill 
               WHERE technicalskill_id = '" . $jobtechnicalskill . "' 
               AND jobpost_id = '" . $_GET['tid'] . "' 
               AND jobtechnicalskill_status = 0";
    $exist = $Con->query($selQry);
    if ($existdata = $exist->fetch_assoc()) {
        ?>
        <script>
            alert("Technical Skill Already Exists");
            window.location = "Jobtechnicalskill.php?tid=<?php echo $_GET['tid']; ?>";
        </script>
        <?php
    } else {
        $insQry = "INSERT INTO tbl_jobtechnicalskill(technicalskill_id, jobpost_id) 
                   VALUES ('" . $jobtechnicalskill . "', '" . $_GET['tid'] . "')";
        if ($Con->query($insQry)) {
            ?>
            <script>
                alert("Insertion Successfully");
                window.location = "Jobtechnicalskill.php?tid=<?php echo $_GET['tid']; ?>";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Insertion Failed");
                window.location = "Jobtechnicalskill.php?tid=<?php echo $_GET['tid']; ?>";
            </script>
            <?php
        }
    }
}

// Remove
if (isset($_GET['rid'])) {
    $upQry = "UPDATE tbl_jobtechnicalskill SET jobtechnicalskill_status = 1 
              WHERE jobtechnicalskill_id = '" . $_GET['rid'] . "' 
              AND jobpost_id = '" . $_GET['tid'] . "'";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Removed");
            window.location = "Jobtechnicalskill.php?tid=<?php echo $_GET['tid']; ?>";
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
    <title>Job Technical Skill</title>


    <style>
        .technicalskill-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .technicalskill-form, .technicalskill-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .technicalskill-form h3, .technicalskill-table h3 {
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
            .technicalskill-form, .technicalskill-table {
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
    <section class="technicalskill-section">
        <div class="container">
            <div class="technicalskill-form">
                <h3>Add Job Technical Skill</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="sel_techskill"></label>
                        <select name="sel_techskill" id="sel_techskill" class="form-control" required>
                            <option value="">-- Select Technical Skill --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_technicalskill WHERE technicalskill_status = 0 ORDER BY technicalskill_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['technicalskill_id']; ?>">
                                <?php echo htmlspecialchars($data['technicalskill_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="technicalskill-table">
                <h3>Job Technical Skill List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Technical Skill</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_jobtechnicalskill j 
                                   INNER JOIN tbl_technicalskill t ON j.technicalskill_id = t.technicalskill_id 
                                   WHERE j.jobtechnicalskill_status = 0 AND j.jobpost_id = '" . $_GET['tid'] . "'";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['technicalskill_name']); ?></td>
                            <td>
                                <a href="Jobtechnicalskill.php?rid=<?php echo $data['jobtechnicalskill_id']; ?>&tid=<?php echo $data['jobpost_id']; ?>" 
                                   class="action-link" 
                                   onclick="return confirm('Are you sure you want to remove this technical skill?');">Remove</a>
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
