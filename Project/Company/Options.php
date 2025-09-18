
<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_POST['btn_submit'])) {
    $option = $_POST['txt_option'];
    $answer = $_POST['rd_iscorrect'];
    
    $selOption = "SELECT * FROM tbl_option WHERE option_iscorrect = '1' AND question_id = '" . $_GET['qid'] . "'";
    $row = $Con->query($selOption);
    if ($row->num_rows > 0 && $answer == 1) {
        ?>
        <script>
            alert("A correct answer already exists for this question");
            window.location = "Options.php?qid=<?php echo $_GET['qid']; ?>";
        </script>
        <?php
    } else {
        $insQry = "INSERT INTO tbl_option(option_options, option_iscorrect, question_id) 
                   VALUES ('" . $option . "', '" . $answer . "', '" . $_GET['qid'] . "')";
        if ($Con->query($insQry)) {
            ?>
            <script>
                alert("Insertion Successfully");
                window.location = "Options.php?qid=<?php echo $_GET['qid']; ?>";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Insertion Failed");
                window.location = "Options.php?qid=<?php echo $_GET['qid']; ?>";
            </script>
            <?php
        }
    }
}

// Delete Option
if (isset($_GET['did'])) {
    $delQry = "DELETE FROM tbl_option WHERE option_id = '" . $_GET['did'] . "' AND question_id = '" . $_GET['qid'] . "'";
    if ($Con->query($delQry)) {
        ?>
        <script>
            alert("Option Deleted");
            window.location = "Options.php?qid=<?php echo $_GET['qid']; ?>";
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
    <title>Question Options</title>


    <style>
        .options-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .options-form, .options-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .options-form h3, .options-table h3 {
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
        }
        .action-link:hover {
            color: #e33a30;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .options-form, .options-table {
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
    <section class="options-section">
        <div class="container">
            <div class="options-form">
                <h3>Add Option</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="txt_option">Option</label>
                        <input type="text" name="txt_option" id="txt_option" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        <div class="radio-group">
                            <label><input type="radio" name="rd_iscorrect" value="1" required /> True</label>
                            <label><input type="radio" name="rd_iscorrect" value="0" /> False</label>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="options-table">
                <h3>Options List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Option</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_option WHERE question_id = '" . $_GET['qid'] . "'";
                        $res = $Con->query($selQry);
                        while ($row = $res->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($row['option_options']); ?></td>
                            <td><?php echo $row['option_iscorrect'] == 1 ? 'True' : 'False'; ?></td>
                            <td>
                                <a href="Options.php?did=<?php echo $row['option_id']; ?>&qid=<?php echo $_GET['qid']; ?>" 
                                   class="action-link" 
                                   onclick="return confirm('Are you sure you want to delete this option?');">Delete</a>
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
