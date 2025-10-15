
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_GET['del_id'])) {
    $complaintId = $_GET['del_id'];
    $delQry = "DELETE FROM tbl_complaint WHERE complaint_id = '" . $complaintId . "' AND user_id = '" . $_SESSION['uid'] . "'";
    if ($Con->query($delQry)) {
        header("Location: Complaint.php");
        exit();
    }
}

if (isset($_POST['btn_submit'])) {
    $title = $_POST['txt_title'];
    $content = $_POST['txt_content'];
    $userId = $_SESSION['uid'];

    $insQry = "INSERT INTO tbl_complaint(complaint_title, complaint_content, user_id, complaint_date) 
               VALUES ('" . $title . "', '" . $content . "', '" . $userId . "', curdate())";
               
    if ($Con->query($insQry)) {
        echo "<script>alert('Complaint Submitted Successfully'); window.location='Complaint.php';</script>";
    } else {
        echo "<script>alert('Failed to Submit Complaint');</script>";
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
    <title>File a Complaint</title>


    <style>
        .complaint-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .complaint-form, .complaint-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto 40px;
        }
        .complaint-form h3, .complaint-table h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group label {
            font-weight: 500;
            color: #222;
        }
        .form-control, .form-control textarea {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .form-control textarea {
            resize: vertical;
            min-height: 100px;
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
        .delete-link {
            color: #f44a40;
            text-decoration: none;
            font-weight: 500;
        }
        .delete-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .complaint-form, .complaint-table {
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
    <section class="complaint-section">
        <div class="container">
            <div class="complaint-form">
                <h3>File a New Complaint</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="txt_title">Title</label>
                        <input type="text" name="txt_title" id="txt_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="txt_content">Content</label>
                        <textarea name="txt_content" id="txt_content" class="form-control" required rows="4"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit Complaint</button>
                    </div>
                </form>
            </div>

            <div class="complaint-table">
                <h3>My Complaints</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>SI.NO</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Reply</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_complaint WHERE user_id = '" . $_SESSION['uid'] . "' ORDER BY complaint_date DESC";
                        $result = $Con->query($selQry);
                        while ($data = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $data['complaint_date'] ?></td>
                            <td><?php echo $data['complaint_title'] ?></td>
                            <td><?php echo $data['complaint_content'] ?></td>
                            <td>
                                <?php
                                if ($data['complaint_status'] == 0) {
                                    echo "Not Replied Yet";
                                } else {
                                    echo $data['complaint_reply'];
                                }
                                ?>
                            </td>
                            <td>
                                <a href="Complaint.php?del_id=<?php echo $data['complaint_id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this complaint?');">Delete</a>
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
