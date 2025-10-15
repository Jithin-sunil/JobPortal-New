<?php
include("../Assets/Connection/Connection.php");
session_start();
include('Header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Complaints</title>
</head>
<body>

<h3>View Complaints</h3>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="8" class = "table table-bordered table-hover">
    <tr >
      <th>SI.NO</th>
      <th>company Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Title</th>
      <th>Content</th>
      
      <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $selqry = "SELECT * 
               FROM tbl_complaint c 
               INNER JOIN tbl_company u ON c.company_id = u.company_id 
               WHERE c.complaint_status = 0
               ORDER BY  c.complaint_date DESC";
    $result = $Con->query($selqry);
    while ($data = $result->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['company_name'] ?></td>
      <td><?php echo $data['company_email'] ?></td>
      <td><?php echo $data['company_contact'] ?></td>
      <td><?php echo $data['complaint_title'] ?></td>
      <td><?php echo $data['complaint_content'] ?></td>
     
      <td>
        <?php
        if ($data['complaint_status'] == 0) {
            echo '<a href="Reply.php?cid=' . $data['complaint_id'] . '" class="btn btn-outline-primary btn-sm">Reply</a>';
        } else {
            echo "Replied";
        }
        ?>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</form>

<h3>Replied Complaints</h3>
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellpadding="8" class = "table table-bordered table-hover">
    <tr >
      <th>SI.NO</th>
      <th>company Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Title</th>
      <th>Content</th>
      
      <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $selqry = "SELECT * 
               FROM tbl_complaint c 
               INNER JOIN tbl_company u ON c.company_id = u.company_id 
                WHERE c.complaint_status=1
               ORDER BY  c.complaint_date DESC";
    $result = $Con->query($selqry);
    while ($data = $result->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['company_name'] ?></td>
      <td><?php echo $data['company_email'] ?></td>
      <td><?php echo $data['company_contact'] ?></td>
      <td><?php echo $data['complaint_title'] ?></td>
      <td><?php echo $data['complaint_content'] ?></td>
     
      <td>
        <?php
        echo $data['complaint_reply'] ;
        ?>
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
include('Footer.php');
?>