
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

$selQry = "SELECT * FROM tbl_jobpost p 
           INNER JOIN tbl_jobtype t ON p.jobtype_id = t.jobtype_id 
           INNER JOIN tbl_category c ON p.category_id = c.category_id  
           WHERE jobpost_id = '" . $_GET['eid'] . "'";
$row = $Con->query($selQry);
$data = $row->fetch_assoc();

$selQry1 = "SELECT * FROM tbl_company c 
            INNER JOIN tbl_companytype t ON c.companytype_id = t.companytype_id 
            WHERE c.company_id = '" . $data['company_id'] . "'";
$row1 = $Con->query($selQry1);
$data1 = $row1->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>Job Details</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/linearicons.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/magnific-popup.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/nice-select.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/animate.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/owl.carousel.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/main.css">

    <style>
        .job-details-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .details-card {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto 40px;
        }
        .details-card h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #222;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table th, .details-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .details-table th {
            font-weight: 500;
            color: #222;
            width: 30%;
        }
        .details-table td {
            color: #555;
        }
        .company-logo {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .apply-btn {
            background: #f44a40;
            border: none;
            padding: 12px 30px;
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        .apply-btn:hover {
            background: #e33a30;
        }
        @media (max-width: 768px) {
            .details-card {
                padding: 20px;
            }
            .details-table th, .details-table td {
                padding: 10px;
                font-size: 14px;
            }
            .company-logo {
                max-width: 80px;
            }
        }
    </style>
</head>
<body>
    <section class="job-details-section">
        <div class="container">
            <div class="details-card">
                <h3>Job Details</h3>
                <table class="details-table">
                    <tr>
                        <th>Title</th>
                        <td><?php echo htmlspecialchars($data['jobpost_title']); ?></td>
                    </tr>
                    <tr>
                        <th>Content</th>
                        <td><?php echo htmlspecialchars($data['jobpost_content']); ?></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><?php echo htmlspecialchars($data['jobtype_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><?php echo htmlspecialchars($data['category_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td><?php echo htmlspecialchars($data['jobpost_experience']); ?></td>
                    </tr>
                    <tr>
                        <th>Last Date</th>
                        <td><?php echo date("d-m-Y", strtotime($data['jobpost_lastdate'])); ?></td>
                    </tr>
                </table>
                <div class="text-center mt-4">
                    <?php
                    $currentDate = date('Y-m-d');
                    $lastDate = $data['jobpost_lastdate'];
                    if ($currentDate <= $lastDate) {
                    ?>
                    <a href="Application.php?eid=<?php echo $data['jobpost_id']; ?>" class="apply-btn">Apply Now</a>
                    <?php } else { ?>
                    <span class="badge-closed">Application Closed</span>
                    <?php } ?>
                </div>
            </div>

            <div class="details-card">
                <h3>Company Details</h3>
                <table class="details-table">
                    <tr>
                        <th>Company Name</th>
                        <td><?php echo htmlspecialchars($data1['company_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($data1['company_email']); ?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo htmlspecialchars($data1['company_contact']); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo htmlspecialchars($data1['company_address']); ?></td>
                    </tr>
                    <tr>
                        <th>Logo</th>
                        <td>
                            <img src="../Assets/Files/Company_Registration/Logo/<?php echo htmlspecialchars($data1['company_logo']); ?>" class="company-logo" alt="Company Logo">
                        </td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><?php echo htmlspecialchars($data1['companytype_name']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>

</body>
</html>
