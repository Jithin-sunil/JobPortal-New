<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$languageid = "";
$languagename = "";

if (isset($_POST["btn_submit"])) {
  $language = $_POST["txt_language"];
  $hid = $_POST["txt_hidden"];

  if ($hid == "") {
    $insQry = "INSERT INTO tbl_language(language_name) VALUES('" . $language . "')";
    if ($Con->query($insQry)) {
?>
      <script>
        alert("Insertion Successfully");
        window.location = "Language.php";
      </script>
<?php
    } else {
      echo "Error";
    }
  } else {
    $upQry = "UPDATE tbl_language SET language_name='" . $language . "' WHERE language_id='" . $hid . "'";
    if ($Con->query($upQry)) {
?>
      <script>
        alert("Updation Successfully");
        window.location = "Language.php";
      </script>
<?php
    } else {
      echo "Error";
    }
  }
}

// Remove
if (isset($_GET['rid'])) {
  $remQry = "UPDATE tbl_language SET language_status=1 WHERE language_id='" . $_GET['rid'] . "'";
  if ($Con->query($remQry)) {
?>
    <script>
      alert("Removal Successfully");
      window.location = "Language.php";
    </script>
<?php
  }
}

// Edit
if (isset($_GET['edit_id'])) {
  $selQry = "SELECT * FROM tbl_language WHERE language_id='" . $_GET['edit_id'] . "'";
  $row = $Con->query($selQry);
  $data = $row->fetch_assoc();

  $languageid = $data['language_id'];
  $languagename = $data['language_name'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Language</title>
</head>

<body>
<div align="center">Language</div>
<form action="" method="post">
  <table class="table table-bordered table-hover">
    <tr>
      <td>Language</td>
      <td>
        <input type="hidden" name="txt_hidden" value="<?php echo $languageid ?>" />
        <input type="text" name="txt_language" id="txt_language" class="form-control" placeholder="Enter Language Name" value="<?php echo $languagename ?>" required/>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-outline-primary"/>
          <input type="reset" name="btn_clear" id="btn_clear" value="Clear" class="btn btn-outline-danger">
        </div>
      </td>
    </tr>
  </table>
  <br><br>
  <div align="center">Language List</div>
  <table class="table table-bordered table-hover">
    <tr>
      <td>Sl.No</td>
      <td>Language</td>
      <td>Action</td>
    </tr>
    <?php
    $i = 0;
    $selQry = "SELECT * FROM tbl_language WHERE language_status=0 ORDER BY language_name ASC";
    $row = $Con->query($selQry);
    while ($data = $row->fetch_assoc()) {
      $i++;
    ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['language_name'] ?></td>
        <td>
          <a href="Language.php?rid=<?php echo $data['language_id'] ?>" class="btn btn-outline-danger">Remove</a>
          <a href="Language.php?edit_id=<?php echo $data['language_id'] ?>" class="btn btn-outline-primary">Edit</a>
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
