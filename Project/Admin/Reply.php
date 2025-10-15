<?php
include("../Assets/Connection/Connection.php");
session_start();

include('Header.php');


$complaintId = $_GET['cid'];

if (isset($_POST['btn_submit'])) {
    $reply = $_POST['txt_reply'];

    $upQry = "UPDATE tbl_complaint 
              SET complaint_reply = '" . $reply . "', complaint_status = 1 
              WHERE complaint_id = '" . $complaintId . "'";

    if ($Con->query($upQry)) {
        echo "<script>
                alert('Reply Sent Successfully');
                window.location = 'ViewComplaint.php';
              </script>";
    } else {
        echo "<script>alert('Failed to send reply.');</script>";
    }
}

$selComp = "SELECT * FROM tbl_complaint WHERE complaint_id = '" . $complaintId . "'";
$resComp = $Con->query($selComp);
$dataComp = $resComp->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reply to Complaint</title>
</head>
<body>

<h3>Reply to the Complaint </h3>

<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="5" class="table table-bordered table-hover" >
    <tr>
      <td>
        <textarea name="txt_reply" id="txt_reply" required rows="5" cols="40" class="form-control" ></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit Reply" class="btn btn-outline-primary"/>
      </td>
    </tr>
  </table>
</form>

</body>
</html>
<?php 
include('Footer.php');
?>