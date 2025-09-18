
<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$editMode = false;
$editId = "";
$editLanguage = "";
$editLevels = [];

# Handle form submission (Add or Update)
if (isset($_POST["btn_submit"])) {
    $language_id = $_POST["sel_language"];
    $levels = isset($_POST["sel_level"]) ? $_POST["sel_level"] : [];

    if (empty($levels)) {
        echo "<script>alert('Please select at least one level.'); window.location='Userlanguage.php';</script>";
    } else {
        $skill_level = implode(",", $levels); // Convert array to comma-separated string

        if (!empty($_POST['edit_id'])) {
            // Update mode
            $editId = $_POST['edit_id'];
            $updQry = "UPDATE tbl_userlanguage 
                       SET language_id = '$language_id', skill_level = '$skill_level' 
                       WHERE userlanguage_id = '$editId'";
            if ($Con->query($updQry)) {
                echo "<script>alert('Updated Successfully'); window.location='Userlanguage.php';</script>";
            } else {
                echo "<script>alert('Update Failed'); window.location='Userlanguage.php';</script>";
            }
        } else {
            // Add mode
            $selQry = "SELECT * FROM tbl_userlanguage 
                       WHERE language_id ='$language_id' 
                       AND user_id = '" . $_SESSION['uid'] . "' 
                       AND userlanguage_status = 0";
            $row = $Con->query($selQry);

            if ($data = $row->fetch_assoc()) {
                echo "<script>alert('Skill already exists'); window.location='Userlanguage.php';</script>";
            } else {
                $insQry = "INSERT INTO tbl_userlanguage(language_id, user_id, skill_level) 
                           VALUES ('$language_id', '" . $_SESSION['uid'] . "', '$skill_level')";
                if ($Con->query($insQry)) {
                    echo "<script>alert('Submitted Successfully'); window.location='Userlanguage.php';</script>";
                } else {
                    echo "<script>alert('Submission Failed'); window.location='Userlanguage.php';</script>";
                }
            }
        }
    }
}

# Remove
if (isset($_GET['rid'])) {
    $remQry = "UPDATE tbl_userlanguage SET userlanguage_status = 1 WHERE userlanguage_id = '" . $_GET['rid'] . "'";
    if ($Con->query($remQry)) {
        echo "<script>alert('Removed Successfully'); window.location='Userlanguage.php';</script>";
    }
}

# Edit
if (isset($_GET['eid'])) {
    $editMode = true;
    $editId = $_GET['eid'];
    $selQry = "SELECT * FROM tbl_userlanguage 
               WHERE userlanguage_id = '$editId'";
    $row = $Con->query($selQry);
    if ($data = $row->fetch_assoc()) {
        $editLanguage = $data['language_id'];
        $editLevels = explode(",", $data['skill_level']);
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
    <title>My Language Skills</title>

    <style>
        .language-section {
            padding: 80px 0;
            background: #f9f9ff;
        }
        .language-form, .language-table {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .language-form h3, .language-table h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
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
        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
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
        .cancel-link {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            margin-left: 15px;
        }
        .cancel-link:hover {
            color: #5a6268;
            text-decoration: underline;
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
            .language-form, .language-table {
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
    <section class="language-section">
        <div class="container">
            <div class="language-form">
                <h3><?php echo $editMode ? "Edit" : "Add"; ?> Language Skill</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="sel_language">Language</label>
                        <select name="sel_language" id="sel_language" class="form-control" required>
                            <option value="">-- Select Language --</option>
                            <?php
                            $selQry = "SELECT * FROM tbl_language WHERE language_status = 0";
                            $row = $Con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['language_id']; ?>" 
                                <?php if ($editLanguage == $data['language_id']) echo "selected"; ?>>
                                <?php echo htmlspecialchars($data['language_name']); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Skill Level</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="sel_level[]" value="Read" 
                                <?php if (in_array("Read", $editLevels)) echo "checked"; ?>> Read</label>
                            <label><input type="checkbox" name="sel_level[]" value="Write" 
                                <?php if (in_array("Write", $editLevels)) echo "checked"; ?>> Write</label>
                            <label><input type="checkbox" name="sel_level[]" value="Speak" 
                                <?php if (in_array("Speak", $editLevels)) echo "checked"; ?>> Speak</label>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($editId); ?>">
                        <button type="submit" name="btn_submit" id="btn_submit" class="primary-btn">
                            <?php echo $editMode ? "Update" : "Submit"; ?>
                        </button>
                        <?php if ($editMode) { ?>
                            <a href="Userlanguage.php" class="cancel-link">Cancel</a>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <div class="language-table">
                <h3>User Language List</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Language</th>
                            <th>Level(s)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_userlanguage u
                                   INNER JOIN tbl_language t ON u.language_id = t.language_id  
                                   WHERE userlanguage_status = 0 AND user_id = '" . $_SESSION['uid'] . "'";
                        $row = $Con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo htmlspecialchars($data['language_name']); ?></td>
                            <td><?php echo htmlspecialchars($data['skill_level']); ?></td>
                            <td>
                                <a href="Userlanguage.php?eid=<?php echo $data['userlanguage_id']; ?>" class="action-link">Edit</a> |
                                <a href="Userlanguage.php?rid=<?php echo $data['userlanguage_id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to remove this skill?')">Remove</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php include("Footer.php"); ?>

</body>
</html>
