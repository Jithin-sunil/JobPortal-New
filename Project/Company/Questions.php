
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $quescategory = $_POST['sel_category'];
    $question = $_POST['txt_question'];
    $photo = $_FILES['file_photo']['name'];
    
    if ($photo != "") {
        $tempphoto = $_FILES['file_photo']['tmp_name'];
        $targetPath = '../Assets/Files/Questions/Photo/' . $photo;
        if (move_uploaded_file($tempphoto, $targetPath)) {
            $insQry = "INSERT INTO tbl_question(question_title, question_file, questioncategory_id, exam_id) 
                       VALUES ('" . $question . "', '" . $photo . "', '" . $quescategory . "', '" . $_GET['eid'] . "')";
        } else {
            ?>
            <script>
                alert("File Upload Failed");
                window.location = "Questions.php?eid=<?php echo $_GET['eid']; ?>";
            </script>
            <?php
            exit;
        }
    } else {
        $insQry = "INSERT INTO tbl_question(question_title, questioncategory_id, exam_id) 
                   VALUES ('" . $question . "', '" . $quescategory . "', '" . $_GET['eid'] . "')";
    }
    
    if ($Con->query($insQry)) {
        ?>
        <script>
            alert("Insertion Successfully");
            window.location = "Questions.php?eid=<?php echo $_GET['eid']; ?>";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Insertion Failed");
            window.location = "Questions.php?eid=<?php echo $_GET['eid']; ?>";
        </script>
        <?php
    }
}

// Delete Question
if (isset($_GET['did'])) {
    $selQry = "SELECT question_file FROM tbl_question WHERE question_id = '" . $_GET['did'] . "' AND exam_id = '" . $_GET['eid'] . "'";
    $result = $Con->query($selQry);
    if ($data = $result->fetch_assoc()) {
        if ($data['question_file'] != "") {
            $filePath = '../Assets/Files/Questions/Photo/' . $data['question_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $delQry = "DELETE FROM tbl_question WHERE question_id = '" . $_GET['did'] . "' AND exam_id = '" . $_GET['eid'] . "'";
        if ($Con->query($delQry)) {
            ?>
            <script>
                alert("Question Deleted");
                window.location = "Questions.php?eid=<?php echo $_GET['eid']; ?>";
            </script>
            <?php
        }
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
    <title>Questions</title>

    <style>
        .questions-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .questions-form, .questions-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .questions-form h3, .questions-table h3 {
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
        .question-image {
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        @media (max-width: 768px) {
            .questions-form, .questions-table {
                padding: 20px;
            }
            .table th, .table td {
                padding: 10px;
                font-size: 14px;
            }
            .question-image {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <section class="questions-section">
        <div class="container">
            <div class="questions-form">
                <h3>Add Question</h3>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="form-group">
                        <label for="sel_category">Category</label>
                        <select name="sel_category" id="sel_category" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_questioncategory WHERE questioncategory_status = 0 ORDER BY questioncategory_name ASC";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['questioncategory_id']; ?>">
                                <?php echo htmlspecialchars($data['questioncategory_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txt_question">Question</label>
                        <input type="text" name="txt_question" id="txt_question" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="file_photo">File (Optional)</label>
                        <input type="file" name="file_photo" id="file_photo" class="form-control" accept="image/*" />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="questions-table">
                <h3>Questions List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Category</th>
                            <th>Question</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_question q 
                                   INNER JOIN tbl_questioncategory qc ON q.questioncategory_id = qc.questioncategory_id 
                                   WHERE q.exam_id = '" . $_GET['eid'] . "'";
                        $result = $Con->query($selQry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($row['questioncategory_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['question_title']); ?></td>
                            <td>
                                <?php if ($row['question_file'] == "") { ?>
                                    No File
                                <?php } else { ?>
                                    <img src="../Assets/Files/Questions/Photo/<?php echo htmlspecialchars($row['question_file']); ?>" 
                                         class="question-image" width="100" height="100" alt="Question Image" />
                                <?php } ?>
                            </td>
                            <td>
                                <a href="Options.php?qid=<?php echo $row['question_id']; ?>&eid=<?php echo $_GET['eid']; ?>" 
                                   class="action-link">Add Option</a>
                                <a href="Questions.php?did=<?php echo $row['question_id']; ?>&eid=<?php echo $_GET['eid']; ?>" 
                                   class="action-link" 
                                   onclick="return confirm('Are you sure you want to delete this question?');">Delete</a>
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
