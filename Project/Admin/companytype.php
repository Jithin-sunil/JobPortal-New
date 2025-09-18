<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$companytypeid = "";
$companytypename = "";

// Insert / Update
if(isset($_POST['btn_submit']))
{
  $companytype = $_POST['txt_companytype'];
  $hidden = $_POST['txt_hidden'];
   
  if($hidden == "")
  {
    $insQry = "insert into tbl_companytype(companytype_name) values('".$companytype."')";	
    if($Con->query($insQry))
    {
      ?>
      <script>
        alert("Insertion Successfully");
        window.location="Companytype.php";
      </script>
      <?php 
    }
    else
    {
      ?>
      <script>
        alert("Insertion Failed");
        window.location="Companytype.php";
      </script>
      <?php	
    }
  }
  else
  {
    $upQry="update tbl_companytype set companytype_name = '".$companytype."' where companytype_id = '".$hidden."' ";
    if($Con->query($upQry))
    { 
      ?>
      <script>
        alert("Updated Successfully");
        window.location="Companytype.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script>
        alert("Error in Update");
        window.location="Companytype.php";
      </script>
      <?php
    }
  }
}

// Remove
if(isset($_GET['rid']))
{
  $remQry=" update tbl_companytype set companytype_status=1 where companytype_id='".$_GET['rid']."'";
  if($Con->query($remQry))   
  {
    ?>
    <script>
      alert("Removal Successfully");
      window.location="Companytype.php";
    </script> 	
    <?php
  }
}

// Edit
if(isset($_GET['eid']))
{
  $selQry="select * from tbl_companytype where companytype_id='".$_GET['eid']."'"; 
  $row=$Con->query($selQry);
  $data=$row->fetch_assoc();
		 
  $companytypeid = $data['companytype_id'];
  $companytypename = $data['companytype_name'];
}
?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company Type</title>
</head>

<body>
<div align="center"><h3>Company Type</h3></div>

<form id="form1" name="form1" method="post" action="">
  <table class="table table-bordered table-hover">
    <tr>
      <td>Company Type</td>
      <td>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $companytypeid ?>"/>
        <input type="text" name="txt_companytype" id="txt_companytype" 
               class="form-control" placeholder="Enter Company Type" 
               value="<?php echo $companytypename ?>" required/>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-outline-primary"/>
          <input type="reset" name="btn_clear" id="btn_clear" value="Clear" class="btn btn-outline-danger"/>
        </div>
      </td>
    </tr>
  </table>

  <br/><br/>
  <div align="center"><h3>Company Type List</h3></div>
  <table class="table table-bordered table-hover">
    <tr>
      <td>Sl.No</td>
      <td>Company Type</td>
      <td>Action</td>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_companytype where companytype_status=0 ORDER BY companytype_name ASC";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
      $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['companytype_name']?></td>
      <td>
        <a href="Companytype.php?rid=<?php echo $data['companytype_id']?>" class="btn btn-outline-danger btn-sm">Remove</a>
        <a href="Companytype.php?eid=<?php echo $data['companytype_id']?>" class="btn btn-outline-primary btn-sm">Edit</a>
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
