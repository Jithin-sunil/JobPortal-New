
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $title = $_POST['txt_title'];
    $content = $_POST['txt_content'];
    $salary_min = $_POST['txt_salary_min'];
    $salary_max = $_POST['txt_salary_max'];
    $experience_min = $_POST['txt_experience_min'];
    $experience_max = $_POST['txt_experience_max'];
    $lastdate = $_POST['txt_lastdate'];
    $recruitment = $_POST['rad_type'];
    $jobtype = $_POST['sel_jobtype'];
    $jobcategory = $_POST['sel_jobcategory'];

    $salary = $salary_min . '-' . $salary_max;
    $experience = $experience_min . '-' . $experience_max;

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Post</title>
<style>
    /* ===== General Page Styling ===== */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f8f9fa;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .jobpost-section {
        padding: 50px 15px;
    }

    /* ===== Form & Table Container ===== */
    .jobpost-form, .jobpost-table {
        background: #fff;
        padding: 35px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        max-width: 1150px;
        margin: 0 auto 40px;
    }

    .jobpost-form h3, .jobpost-table h3 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
        color: #f44a40;
    }

    /* ===== Form Layout ===== */
    .jobpost-form form {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 15px 20px;
        align-items: start;  /* ensure vertical alignment starts from top */
    }

    .jobpost-form label {
        justify-self: start;   /* ✅ align labels to left */
        align-self: start;     /* ✅ align labels to top */
        text-align: left;      /* ✅ ensure text is left-aligned */
        font-weight: 600;
        color: #444;
        padding-right: 10px;
    }

    .jobpost-form .form-group {
        grid-column: 1 / span 2;
        margin-bottom: 20px;
    }

    .jobpost-form .form-group.inline {
        grid-column: auto;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .jobpost-form .form-control, .jobpost-form textarea, .jobpost-form select {
        width: 100%;
        padding: 12px 15px;
        border-radius: 10px;
        border: 1px solid #ddd;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .jobpost-form .form-control:focus, textarea:focus, select:focus {
        border-color: #f44a40;
        box-shadow: 0 0 10px rgba(244, 74, 64, 0.2);
        outline: none;
    }

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }

    .radio-group {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .primary-btn {
        background: linear-gradient(135deg, #f44a40, #e33a30);
        border: none;
        padding: 14px 40px;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        grid-column: 2;
        justify-self: start;
    }

    .primary-btn:hover {
        background: linear-gradient(135deg, #e33a30, #d12b23);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(243, 74, 64, 0.3);
    }

    /* ===== Table Styling ===== */
    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        border-radius: 15px;
        overflow: hidden;
        min-width: 1000px;
    }

    .table th, .table td {
        padding: 14px 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .table th {
        background: #f44a40;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
    }

    .table td {
        background: #fff;
        color: #555;
    }

    .table tr:hover td {
        background: #ffeaea;
        transition: all 0.2s ease;
    }

    .action-link {
        color: #f44a40;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }

    .action-link:hover {
        color: #e33a30;
        text-decoration: underline;
    }

    @media (max-width: 1200px) {
        .jobpost-form, .jobpost-table { padding: 30px 20px; }
    }

    @media (max-width: 992px) {
        .radio-group { flex-direction: column; gap: 12px; }
    }

    @media (max-width: 768px) {
        .table th, .table td { font-size: 14px; padding: 10px 8px; }
    }

    @media (max-width: 576px) {
        .primary-btn { width: 100%; padding: 12px; }
    }

/* Ensure the form-group itself doesn't center children */
.jobpost-form .form-group {
  text-align: left !important;
}

/* Force labels to be block-level and left-aligned */
.jobpost-form .form-group label {
  display: block !important;
  width: 100% !important;
  text-align: left !important;
  margin: 0 0 10px 0;
  font-weight: 600;
  color: #444;
  padding-right: 10px;
}

/* Radio labels (optional) — makes the radio text left-aligned too */
.jobpost-form .radio-group label {
  display: inline-block !important;
  text-align: left !important;
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
                <input type="text" name="txt_title" id="txt_title" class="form-control" required 
                       minlength="5" maxlength="50" placeholder="Enter job title (5-50 chars)" />
            </div>

                     <div class="form-group">
                        <label for="txt_content">Job Description</label>
                          <textarea name="txt_content" id="txt_content" class="form-control" required 
                          minlength="20" maxlength="1500" placeholder="Describe the job in detail (20 - 1500 chars)"></textarea>
                     </div>

            <div class="form-group">
                <label for="txt_salary">Salary</label>
                <input type="text" name="txt_salary" id="txt_salary" class="form-control" required
                       min="1" max="50" placeholder="eg. ₹10,0000 to 20,0000" />

                    <div class="form-group">
                        <label for="sel_jobcategory">Job Category</label>
                        <select name="sel_jobcategory" id="sel_jobcategory" class="form-control" required>
                            <option value="">- Select Category -</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_category WHERE category_status = 0 ORDER BY category_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                                echo '<option value="'.$data['category_id'].'">'.htmlspecialchars($data['category_name']).'</option>';
                            }
                            ?>
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
                                echo '<option value="'.$data['jobtype_id'].'">'.htmlspecialchars($data['jobtype_name']).'</option>';
                            }
                            ?>
                        </select>
                    </div>

                   <div class="form-group">
                   <label for="txt_experience">Experience (Years)</label>
                    <input type="text" name="txt_experience" id="txt_experience" class="form-control" required
                     pattern="^[0-9]{1,2}\s*-\s*[0-9]{1,2}\s*(years|yrs)?$" 
                   title="Enter experience as min-max, e.g., 1-5 years or 2-4 yrs" 
                    placeholder="Experience (e.g., 1-5 years)" />
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

                    <div class="form-group">
                        <button type="submit" name="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="jobpost-table">
                <h3>Job Post List</h3>
                <div class="table-container">
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
                                $salary_display = '₹'.str_replace('-', ' - ₹', $data['jobpost_salary']);
                                $experience_display = str_replace('-', ' - ', $data['jobpost_experience']);
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo htmlspecialchars($data['jobpost_title']); ?></td>
                                <td><?php echo $salary_display; ?></td>
                                <td><?php echo htmlspecialchars($data['jobpost_content']); ?></td>
                                <td><?php echo $experience_display; ?></td>
                                <td><?php echo htmlspecialchars($data['jobtype_name']); ?></td>
                                <td><?php echo htmlspecialchars($data['category_name']); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($data['jobpost_lastdate'])); ?></td>
                                <td>
                                    <a href="Jobpost.php?rid=<?php echo $data['jobpost_id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to remove this job post?');">Remove</a>
                                    <a href="Jobqualification.php?pid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Qualification</a>
                                    <a href="Joblanguage.php?lid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Language</a>
                                    <a href="Jobtechnicalskill.php?tid=<?php echo $data['jobpost_id']; ?>" class="action-link">Add Technical Skill</a>
                                    <a href="Resubmission.php?tid=<?php echo $data['jobpost_id']; ?>" class="action-link">Extend Date</a>
                                </td>
                                <td>
                                    <?php 
                                    if ($data['jobpost_recruitment'] == 0) {  
                                        $examQry = "SELECT exam_id, exam_status 
                                                    FROM tbl_exam 
                                                    WHERE jobpost_id = " . $data['jobpost_id'] . " 
                                                    ORDER BY exam_id DESC LIMIT 1"; 
                                        $examRes = $Con->query($examQry);

                                        if ($examRes->num_rows > 0) {
                                            $exam = $examRes->fetch_assoc();

                                            if ($exam['exam_status'] == 2) {
                                                echo '<a href="ViewResult.php?jid=' . $data['jobpost_id'] . '" class="action-link">View Result</a>';
                                            } else {
                                                echo '<a href="Exam.php?eid=' . $data['jobpost_id'] . '" class="action-link">Add/Update Exam</a>';
                                            }
                                        } else {
                                            echo '<a href="Exam.php?eid=' . $data['jobpost_id'] . '" class="action-link">Add Exam</a>';
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

    <?php include('Footer.php'); ?>

</body>
</html>
