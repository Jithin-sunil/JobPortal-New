
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

// Accept Applicant
if (isset($_GET['aid'])) {
    $upQry = "UPDATE tbl_application SET application_status = 1 
              WHERE application_id = '" . $_GET['aid'] . "' 
              AND jobpost_id IN (SELECT jobpost_id FROM tbl_jobpost WHERE company_id = '" . $_SESSION['cid'] . "')";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Accepted");
            window.location = "ViewApplication.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Failed to Accept");
            window.location = "ViewApplication.php";
        </script>
        <?php
    }
}

// Reject Applicant
if (isset($_GET['rid'])) {
    $upQry = "UPDATE tbl_application SET application_status = 2 
              WHERE application_id = '" . $_GET['rid'] . "' 
              AND jobpost_id IN (SELECT jobpost_id FROM tbl_jobpost WHERE company_id = '" . $_SESSION['cid'] . "')";
    if ($Con->query($upQry)) {
        ?>
        <script>
            alert("Rejected");
            window.location = "ViewApplication.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Failed to Reject");
            window.location = "ViewApplication.php";
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
    <title>View Applications</title>

    <style>
        .application-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .application-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }
        .application-table h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #222;
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
        .status-accepted {
            color: #28a745;
            font-weight: 500;
        }
        .status-rejected {
            color: #dc3545;
            font-weight: 500;
        }
        .status-unavailable {
            color: #6c757d;
            font-weight: 500;
        }
        .user-details, .job-details {
            line-height: 1.8;
        }
        @media (max-width: 768px) {
            .application-table {
                padding: 20px;
            }
            .table th, .table td {
                padding: 10px;
                font-size: 14px;
            }
            .user-details, .job-details {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <section class="application-section">
        <div class="container">
            <div class="application-table">
                <h3>View Applications</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>User Details</th>
                            <th>Job Details</th>
                            <th>Apply Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_application a 
                                   INNER JOIN tbl_user u ON a.user_id = u.user_id 
                                   INNER JOIN tbl_jobpost p ON a.jobpost_id = p.jobpost_id 
                                   INNER JOIN tbl_company c ON c.company_id = p.company_id 
                                   WHERE c.company_id = '" . $_SESSION['cid'] . "'";
                        $row = $Con->query($selQry);
                        if ($row->num_rows == 0) {
                            ?>
                            <tr>
                                <td colspan="5" class="text-center" style="color: #f44a40;">No applications found.</td>
                            </tr>
                            <?php
                        } else {
                            while ($data = $row->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="user-details">
                                        <strong>Name:</strong> <?php echo htmlspecialchars($data['user_name']); ?><br>
                                        <strong>Contact:</strong> <?php echo htmlspecialchars($data['user_contact']); ?><br>
                                        <strong>Email:</strong> <?php echo htmlspecialchars($data['user_email']); ?><br>
                                        <strong>Address:</strong> <?php echo htmlspecialchars($data['user_address']); ?>
                                    </td>
                                    <td class="job-details">
                                        <strong>Job Post:</strong> <?php echo htmlspecialchars($data['jobpost_title']); ?><br>
                                        <strong>Experience:</strong> <?php echo htmlspecialchars($data['jobpost_experience']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($data['application_date']); ?></td>
                                    <td>
                                        <?php
                                        if ($data['application_status'] == 0) {
                                            ?>
                                            <a href="ViewApplication.php?aid=<?php echo $data['application_id']; ?>" 
                                               class="action-link" 
                                               onclick="return confirm('Are you sure you want to accept this applicant?');">Accept</a>
                                            <a href="ViewApplication.php?rid=<?php echo $data['application_id']; ?>" 
                                               class="action-link" 
                                               onclick="return confirm('Are you sure you want to reject this applicant?');">Reject</a>
                                            <?php
                                        } elseif ($data['application_status'] == 1) {
                                            ?>
                                            <span class="status-accepted">Accepted</span><br>
                                            <a href="ViewApplication.php?rid=<?php echo $data['application_id']; ?>" 
                                               class="action-link" 
                                               onclick="return confirm('Are you sure you want to reject this applicant?');">Reject</a>
                                            <?php
                                        } elseif ($data['application_status'] == 2) {
                                            ?>
                                            <span class="status-rejected">Rejected</span><br>
                                            <a href="ViewApplication.php?aid=<?php echo $data['application_id']; ?>" 
                                               class="action-link" 
                                               onclick="return confirm('Are you sure you want to accept this applicant?');">Accept</a>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="status-unavailable">Temporarily Unavailable</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>

</body>
</html>
