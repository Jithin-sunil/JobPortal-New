
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

$selQry = "SELECT * FROM tbl_user u 
           INNER JOIN tbl_place p ON u.place_id = p.place_id 
           INNER JOIN tbl_district d ON p.district_id = d.district_id 
           INNER JOIN tbl_state s ON d.state_id = s.state_id 
           WHERE user_id = '" . $_SESSION['uid'] . "'";
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
        }
        .profile-image {
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }
        .profile-table th, .profile-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .profile-table th {
            font-weight: 500;
            color: #222;
            width: 30%;
        }
        .profile-table td {
            color: #555;
        }
        .action-links {
            text-align: center;
            margin-top: 20px;
        }
        .action-links a {
            color: #f44a40;
            text-decoration: none;
            font-weight: 500;
            margin: 0 10px;
        }
        .action-links a:hover {
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
            .profile-image {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <section class="profile-section">
        <div class="container">
            <div class="profile-card">
                <h3>My Profile</h3>
                <img src="../Assets/Files/User_Registration/Photo/<?php echo htmlspecialchars($data['user_photo']); ?>" width="150" height="150" class="profile-image" alt="User Photo">
                <table class="profile-table">
                    <tr>
                        <th>Name</th>
                        <td><?php echo htmlspecialchars($data['user_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($data['user_email']); ?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo htmlspecialchars($data['user_contact']); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo htmlspecialchars($data['user_address']); ?></td>
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
                </table>
                <div class="action-links">
                    <a href="Editprofile.php">Edit Profile</a> | <a href="Changepass.php">Change Password</a>
                </div>
            </div>
        </div>
    </section>

    <?php include('Footer.php'); ?>
</body>
</html>
