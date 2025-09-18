
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

$selQry = "SELECT * FROM tbl_company c 
           INNER JOIN tbl_place p ON c.place_id = p.place_id 
           INNER JOIN tbl_district d ON p.district_id = d.district_id 
           INNER JOIN tbl_state s ON d.state_id = s.state_id 
           WHERE c.company_id = '" . $_SESSION['cid'] . "'";
$row = $Con->query($selQry);
$data = $row->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codepixer">
    <title>My Profile</title>

    <style>
        .profile-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .profile-card {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-card h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #222;
        }
        .profile-card img {
            display: block;
            margin: 0 auto 20px;
            border-radius: 10px;
            border: 2px solid #ddd;
        }
        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }
        .profile-table th, .profile-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .profile-table th {
            background: #ef9692ff;
            color: #fff;
            font-weight: 600;
            width: 30%;
        }
        .profile-table td {
            background: #fff;
            color: #555;
        }
        .action-link {
            color: #f44a40;
            text-decoration: none;
            font-weight: 500;
            margin: 0 10px;
        }
        .action-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .profile-card {
                padding: 20px;
            }
            .profile-table th, .profile-table td {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <section class="profile-section">
        <div class="container">
            <div class="profile-card">
                <h3>My Profile</h3>
                <?php if ($data) { ?>
                    <img src="../Assets/Files/Company_Registration/Logo/<?php echo htmlspecialchars($data['company_logo']); ?>" 
                         width="150" height="150" alt="Company Logo">
                    <table class="profile-table">
                        <tr>
                            <th>Name</th>
                            <td><?php echo htmlspecialchars($data['company_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($data['company_email']); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo htmlspecialchars($data['company_address']); ?></td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td><?php echo htmlspecialchars($data['state_name']); ?></td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td><?php echo htmlspecialchars($data['district_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Place</th>
                            <td><?php echo htmlspecialchars($data['place_name']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="Editprofile.php" class="action-link">Edit Profile</a> | 
                                <a href="Changepass.php" class="action-link">Change Password</a>
                            </td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <p class="text-center" style="color: #f44a40;">No profile data found.</p>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>

</body>
</html>
