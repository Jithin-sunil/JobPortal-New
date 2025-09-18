
<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

if (isset($_POST["btn_submit"])) {
    $skill_id = $_POST["sel_tskill"];
    
    $selQry = "SELECT * FROM tbl_usertechnicalskill WHERE technicalskill_id = '" . $_POST["sel_tskill"] . "' AND user_id = '" . $_SESSION['uid'] . "'";
    $row = $Con->query($selQry);
    if ($data = $row->fetch_assoc()) {
        ?>
        <script>
            alert("Skill already exists");
            window.location = "Usertechnicalskill.php";
        </script>
        <?php
    } else {
        $insQry = "INSERT INTO tbl_usertechnicalskill(technicalskill_id, user_id) VALUES ('" . $skill_id . "', '" . $_SESSION['uid'] . "')";
        if ($Con->query($insQry)) {
            ?>
            <script>
                alert("Submitted Successfully");
                window.location = "Usertechnicalskill.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Wrong submission");
                window.location = "Usertechnicalskill.php";
            </script>
            <?php
        }
    }
}

# Remove
if (isset($_GET['rid'])) {
    $remQry = "UPDATE tbl_usertechnicalskill SET usertechnicalskill_status = 1 WHERE usertechnicalskill_id = '" . $_GET['rid'] . "'";
    if ($Con->query($remQry)) {
        ?>
        <script>
            alert("Removal Successfully");
            window.location = "Usertechnicalskill.php";
        </script>
        <?php
    }
}

/* # Edit
if (isset($_GET['eid'])) {
    $selQry = "SELECT * FROM tbl_usertechnicalskill WHERE usertechnicalskill_id = '" . $_GET['eid'] . "'";
    $row = $Con->query($selQry);
    $data = $row->fetch_assoc();
    
    $tskillid = $data['usertechnicalskill_id'];
    $sid = $data['technicalskill_id'];
}
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>My Technical Skills</title>

    <style>
        .skill-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .skill-form, .skill-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .skill-form h3, .skill-table h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
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
            .skill-form, .skill-table {
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
    <section class="skill-section">
        <div class="container">
            <div class="skill-form">
                <h3>Add Technical Skill</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="sel_tskill">Technical Skill</label>
                        <select name="sel_tskill" id="sel_tskill" class="form-control" required>
                            <option value="">-- Select Technical Skill --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_technicalskill WHERE technicalskill_status = 0";
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

            <div class="skill-table">
                <h3>My Technical Skills</h3>
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
                        $selQry = "SELECT * FROM tbl_usertechnicalskill u
                                   INNER JOIN tbl_technicalskill t ON u.technicalskill_id = t.technicalskill_id  
                                   WHERE usertechnicalskill_status = 0 AND user_id = '" . $_SESSION['uid'] . "'";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['technicalskill_name']); ?></td>
                            <td>
                                <a href="Usertechnicalskill.php?rid=<?php echo $data['usertechnicalskill_id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to remove this skill?')">Remove</a>
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
