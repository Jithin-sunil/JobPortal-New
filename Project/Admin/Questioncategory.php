<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$questioncategoryid   = "";
$questioncategoryname = "";
$questioncategorytime = "";
$questioncategorymark = "";

// Insert / Update
if (isset($_POST['btn_submit'])) {
    $quescategory = $_POST['txt_quescategory'];
    $time         = $_POST['txt_time'];
    $mark         = $_POST['txt_mark'];
    $hidden       = $_POST['txt_hidden'];

    if ($hidden == "") {
        // Insert new category
        $insQry = "INSERT INTO tbl_questioncategory(questioncategory_name, questioncategory_time, questioncategory_mark) 
                   VALUES ('$quescategory', '$time', '$mark')";
        if ($Con->query($insQry)) {
            echo "<script>alert('Insertion Successfully'); window.location='Questioncategory.php';</script>";
        } else {
            echo "<script>alert('Insertion FAILED'); window.location='Questioncategory.php';</script>";
        }
    } else {
        // Update existing category
        $updQry = "UPDATE tbl_questioncategory 
                   SET questioncategory_name='$quescategory', 
                       questioncategory_time='$time', 
                       questioncategory_mark='$mark' 
                   WHERE questioncategory_id='$hidden'";
        if ($Con->query($updQry)) {
            echo "<script>alert('Updated Successfully'); window.location='Questioncategory.php';</script>";
        } else {
            echo "<script>alert('Update FAILED'); window.location='Questioncategory.php';</script>";
        }
    }
}

// Remove
if (isset($_GET['rid'])) {
    $remQry = "UPDATE tbl_questioncategory SET questioncategory_status = 1 WHERE questioncategory_id = '" . $_GET['rid'] . "'";
    if ($Con->query($remQry)) {
        echo "<script>alert('Removed'); window.location='Questioncategory.php';</script>";
    }
}

// Edit
if (isset($_GET['eid'])) {
    $selQry = "SELECT * FROM tbl_questioncategory WHERE questioncategory_id='" . $_GET['eid'] . "'";
    $row    = $Con->query($selQry);
    if ($data = $row->fetch_assoc()) {
        $questioncategoryid   = $data['questioncategory_id'];
        $questioncategoryname = $data['questioncategory_name'];
        $questioncategorytime = $data['questioncategory_time'];
        $questioncategorymark = $data['questioncategory_mark'];
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Question Category</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center" class="mb-3"><h3>Question Category</h3></div>

  <table class="table table-bordered table-hover" style="width:60%; margin:auto;">
    <tr>
      <td>Category Name</td>
      <td>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value ="<?php echo $questioncategoryid ?>"/>
        <input type="text" name="txt_quescategory" id="txt_quescategory" 
               class="form-control" placeholder="Enter Question Category"
               value ="<?php echo $questioncategoryname ?>" required/>
      </td>
    </tr>
    <tr>
      <td>Duration (Minutes)</td>
      <td>
        <input type="number" name="txt_time" id="txt_time" class="form-control"
               placeholder="Enter Time in Minutes"
               value ="<?php echo $questioncategorytime ?>" required/>
      </td>
    </tr>
    <tr>
      <td>Mark per Question</td>
      <td>
        <input type="number" name="txt_mark" id="txt_mark" class="form-control"
               placeholder="Enter Mark per Question"
               value ="<?php echo $questioncategorymark ?>" required/>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-outline-primary"/>
        <input type="reset" name="btn_clear" id="btn_clear" value="Clear" class="btn btn-outline-danger"/>
      </td>
    </tr>
  </table>
  
  <br><br>
  <div align="center"><h3>Question Category List</h3></div>

  <table class="table table-bordered table-hover" style="width:80%; margin:auto;">
    <tr>
      <th>Sl.No</th>
      <th>Category Name</th>
      <th>Duration (Minutes)</th>
      <th>Mark/Question</th>
      <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $selQry = "SELECT * FROM tbl_questioncategory WHERE questioncategory_status=0 ORDER BY questioncategory_name ASC";
    $row = $Con->query($selQry);
    while ($data = $row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo htmlspecialchars($data['questioncategory_name']) ?></td>
      <td><?php echo htmlspecialchars($data['questioncategory_time']) ?></td>
      <td><?php echo htmlspecialchars($data['questioncategory_mark']) ?></td>
      <td>
        <a href="Questioncategory.php?rid=<?php echo $data['questioncategory_id']?>" class="btn btn-outline-danger btn-sm">Remove</a>
        <a href="Questioncategory.php?eid=<?php echo $data['questioncategory_id']?>" class="btn btn-outline-primary btn-sm">Edit</a>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</form>
</body>
</html>

<?php 
include("Footer.php");
?>
