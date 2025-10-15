<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

$selQry = "SELECT *
           FROM tbl_application a
           INNER JOIN tbl_jobpost p ON a.jobpost_id = p.jobpost_id
           INNER JOIN tbl_company c ON p.company_id = c.company_id
           LEFT JOIN tbl_exam e ON a.jobpost_id = e.jobpost_id 
           WHERE a.user_id = '" . $_SESSION['uid'] . "'";
$row = $Con->query($selQry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>My Applications</title>

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
        .status-link {
            color: #f44a40;
            text-decoration: none;
            font-weight: 500;
        }
        .status-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        .status-pending {
            color: #ffc107;
            font-weight: 500;
        }
        .status-accepted {
            color: #28a745;
            font-weight: 500;
        }
        .status-rejected {
            color: #dc3545;
            font-weight: 500;
        }
        .status-info {
            color: #007bff;
            font-weight: 500;
        }
        @media (max-width: 768px) {
            .application-table {
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
    <section class="application-section">
        <div class="container">
            <div class="application-table">
                <h3>My Applications</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Job Details</th>
                            <th>Company Details</th>
                            <th>Apply Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <strong>Job Post:</strong> <?php echo htmlspecialchars($data['jobpost_title']); ?><br><br>
                                <strong>Experience:</strong> <?php echo htmlspecialchars($data['jobpost_experience']); ?>
                            </td>
                            <td>
                                <strong>Name:</strong> <?php echo htmlspecialchars($data['company_name']); ?><br><br>
                                <strong>Contact:</strong> <?php echo htmlspecialchars($data['company_contact']); ?><br><br>
                                <strong>Email:</strong> <?php echo htmlspecialchars($data['company_email']); ?>
                            </td>
                            <td><?php echo date("d-m-Y", strtotime($data['application_date'])); ?></td>
                            <td>
                                <?php
                                if ($data['application_status'] == 0) {
                                    echo '<span class="status-pending">Application Pending.</span>';
                                } elseif ($data['application_status'] == 1) {
                                    echo '<span class="status-accepted">Application Accepted.</span>';
                                    
                                    if ($data['jobpost_recruitment'] == 0) {
                                        $examDate = date("Y-m-d", strtotime($data['exam_date'])); 
                                        $today    = date("Y-m-d");

                                        if (($examDate == $today) && ($data['exam_status'] == 1)) {
                                            echo '<br><a href="Exam.php?jid=' . htmlspecialchars($data['jobpost_id']) . '" class="status-link">Start Exam</a>';
                                        } else if ($data['exam_status'] == 2) {
                                            echo '<br><span class="status-info">Exam completed. Our team will contact you soon.</span>';
                                        } else {
                                            echo '<br>Exam Date: ' . date("d-m-Y H:i", strtotime($data['exam_date']));
                                        }
                                    } else {
                                        echo '<br>Our team will contact you soon.';
                                    }
                                } else if ($data['application_status'] == 3) {
                                    echo '<span class="status-rejected">Our team will contact you soon</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
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
