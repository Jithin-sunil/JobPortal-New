
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $examdate = $_POST['txt_date'];
    $insQry = "INSERT INTO tbl_exam(jobpost_id, exam_date) VALUES ('" . $_GET['eid'] . "', '" . $examdate . "')";
    if ($Con->query($insQry)) {
        ?>
        <script>
            alert("Insertion Successfully");
            window.location = "Exam.php?eid=<?php echo $_GET['eid']; ?>";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Insertion Failed");
            window.location = "Exam.php?eid=<?php echo $_GET['eid']; ?>";
        </script>
        <?php
    }
}

// Remove
if (isset($_GET['rid'])) {
    $upQry = "UPDATE tbl_exam SET exam_status = 1 WHERE exam_id = '" . $_GET['rid'] . "'";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Removed");
            window.location = "Exam.php?eid=<?php echo $_GET['eid']; ?>";
        </script>
        <?php
    }
}

// Update Exam Status
if (isset($_GET['sid'])) {
    $upQry = "UPDATE tbl_exam SET exam_status = '" . $_GET['sts'] . "' WHERE exam_id = '" . $_GET['sid'] . "'";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Exam Status Updated");
            window.location = "Exam.php?eid=<?php echo $_GET['eid']; ?>";
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
    <title>Exam Date Declaration</title>

    <style>
        .exam-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .exam-form, .exam-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .exam-form h3, .exam-table h3 {
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
            margin-right: 10px;
        }
        .action-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        .status-completed {
            color: #6c757d;
            font-style: italic;
        }
        @media (max-width: 768px) {
            .exam-form, .exam-table {
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
    <section class="exam-section">
        <div class="container">
            <div class="exam-form">
                <h3>Exam Date Declaration</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="txt_date">Exam Date</label>
                        <input type="datetime-local" name="txt_date" id="txt_date" class="form-control" 
                               min="<?php echo date('Y-m-d\TH:i'); ?>" required />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="exam-table">
                <h3>Exam Date Declaration List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Exam Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_exam WHERE jobpost_id = '" . $_GET['eid'] . "' AND exam_status IN (0, 1, 2)";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['exam_date']); ?></td>
                            <td>
                                <?php if ($data['exam_status'] == 0) { ?>
                                    <a href="Exam.php?rid=<?php echo $data['exam_id']; ?>&eid=<?php echo $_GET['eid']; ?>" class="action-link" onclick="return confirm('Are you sure you want to remove this exam?');">Remove</a>
                                    <a href="Questions.php?eid=<?php echo $data['exam_id']; ?>" class="action-link">Add Question</a>
                                    <a href="Exam.php?sid=<?php echo $data['exam_id']; ?>&sts=1&eid=<?php echo $_GET['eid']; ?>" class="action-link" onclick="return confirm('Are you sure you want to start this exam?');">Start Exam</a>
                                <?php } elseif ($data['exam_status'] == 1) { ?>
                                    <a href="Exam.php?sid=<?php echo $data['exam_id']; ?>&sts=2&eid=<?php echo $_GET['eid']; ?>" class="action-link" onclick="return confirm('Are you sure you want to end this exam?');">End Exam</a>
                                <?php } else { ?>
                                    <span class="status-completed">Exam Completed</span>
                                <?php } ?>
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
