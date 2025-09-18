
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $title = $_POST['txt_title'];
    $content = $_POST['txt_content'];
    $salary = $_POST['txt_salary'];
    $experience = $_POST['txt_experience'];
    $lastdate = $_POST['txt_lastdate'];
    $recruitment = $_POST['rad_type'];
    $jobtype = $_POST['sel_jobtype'];
    $jobcategory = $_POST['sel_jobcategory'];

    $insQry = "INSERT INTO tbl_jobpost(jobpost_title, jobpost_content, jobpost_salary, jobpost_experience, jobtype_id, category_id, jobpost_lastdate, jobpost_recruitment, jobpost_date, company_id) 
               VALUES ('" . $title . "', '" . $content . "', '" . $salary . "', '" . $experience . "', '" . $jobtype . "', '" . $jobcategory . "', '" . $lastdate . "', '" . $recruitment . "', curdate(), '" . $_SESSION['cid'] . "')";
    
    if ($Con->query($insQry)) {
        ?>
        <script>
            alert("Insertion Successfully");
            window.location = "Jobpost.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Insertion Failed");
            window.location = "Jobpost.php";
        </script>
        <?php
    }
}

// Remove
if (isset($_GET['rid'])) {
    $upQry = "UPDATE tbl_jobpost SET jobpost_status = 1 WHERE jobpost_id = '" . $_GET['rid'] . "' AND company_id = '" . $_SESSION['cid'] . "'";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Removed");
            window.location = "Jobpost.php";
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
    <title>Job Post</title>


    <style>
        .jobpost-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .jobpost-form, .jobpost-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto 40px;
        }
        .jobpost-form h3, .jobpost-table h3 {
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
        .form-control, .form-control textarea, .form-control select {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .form-control textarea {
            resize: vertical;
            min-height: 100px;
        }
        .radio-group {
            display: flex;
            gap: 20px;
        }
        .radio-group label {
            font-weight: 400;
            color: #555;
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
            display: block;
            margin-bottom: 5px;
        }
        .action-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .jobpost-form, .jobpost-table {
                padding: 20px;
            }
            .table th, .table td {
                padding: 10px;
                font-size: 14px;
            }
            .radio-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <section class="jobpost-section">
        <div class="container">
            <div class="jobpost-form">
                <h3><?php echo htmlspecialchars($_SESSION['cname']); ?> Job Post</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="txt_title">Job Title</label>
                        <input type="text" name="txt_title" id="txt_title" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="txt_content">Job Description</label>
                        <textarea name="txt_content" id="txt_content" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txt_salary">Salary</label>
                        <input type="text" name="txt_salary" id="txt_salary" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="sel_jobcategory">Job Category</label>
                        <select name="sel_jobcategory" id="sel_jobcategory" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_category WHERE category_status = 0 ORDER BY category_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['category_id']; ?>">
                                <?php echo htmlspecialchars($data['category_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sel_jobtype">Job Type</label>
                        <select name="sel_jobtype" id="sel_jobtype" class="form-control" required>
                            <option value="">-- Select Job Type --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_jobtype WHERE jobtype_status = 0 ORDER BY jobtype_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['jobtype_id']; ?>">
                                <?php echo htmlspecialchars($data['jobtype_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txt_experience">Experience</label>
                        <input type="text" name="txt_experience" id="txt_experience" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="txt_lastdate">Submission Last Date</label>
                        <input type="date" name="txt_lastdate" id="txt_lastdate" class="form-control" min="<?php echo date('Y-m-d'); ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Recruitment Type</label>
                        <div class="radio-group">
                            <label><input type="radio" name="rad_type" value="0" required /> Through Exam</label>
                            <label><input type="radio" name="rad_type" value="1" /> Direct Interview</label>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="jobpost-table">
                <h3>Job Post List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Job Title</th>
                            <th>Salary</th>
                            <th>Job Description</th>
                            <th>Experience</th>
                            <th>Job Type</th>
                            <th>Job Category</th>
                            <th>Submission Last Date</th>
                            <th>Action</th>
                            <th>Exam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_jobpost p 
                                   INNER JOIN tbl_jobtype t ON p.jobtype_id = t.jobtype_id 
                                   INNER JOIN tbl_category c ON p.category_id = c.category_id 
                                   WHERE p.jobpost_status = 0 AND p.company_id = '" . $_SESSION['cid'] . "' 
                                   ORDER BY p.jobpost_date DESC";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['jobpost_title']); ?></td>
                            <td><?php echo htmlspecialchars($data['jobpost_salary']); ?></td>
                            <td><?php echo htmlspecialchars($data['jobpost_content']); ?></td>
                            <td><?php echo htmlspecialchars($data['jobpost_experience']); ?></td>
                            <td><?php echo htmlspecialchars($data['jobtype_name']); ?></td>
                            <td><?php echo htmlspecialchars($data['category_name']); ?></td>
                            <td><?php echo htmlspecialchars($data['jobpost_lastdate']); ?></td>
                            <td>
                                <a href="Jobpost.php?rid=<?php echo $data['jobpost_id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to remove this job post?');">Remove</a>
                                <a href="Jobqualification.php?pid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Qualification</a>
                                <a href="Joblanguage.php?lid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Language</a>
                                <a href="Jobtechnicalskill.php?tid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Technical Skill</a>
                                <a href="Resubmission.php?tid=<?php echo $data['jobpost_id']; ?>" class="action-link">Extend Date</a>
                            </td>
                            <td>
                                <?php if ($data['jobpost_recruitment'] == 0) { ?>
                                    <a href="Exam.php?eid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Exam</a>
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
