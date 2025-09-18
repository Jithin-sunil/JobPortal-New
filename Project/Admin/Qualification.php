<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$qualificationid = "";
$qualificationname = "";

if(isset($_POST['btn_submit']))
{
  $qualification=$_POST['txt_qualification'];	
  $hidden=$_POST['txt_hidden'];
  
  if($hidden=="")
  {
    $insQry="insert into tbl_qualification(qualification_name) values('".$qualification."')";
    if($Con->query($insQry))  
    {
      ?>
      <script>
        alert("Insertion Successfully");
        window.location="Qualification.php";
      </script>
      <?php 
    }
    else
    {
      ?>
      <script>
        alert("Insertion failed");
        window.location="Qualification.php";
      </script>
      <?php	
    }
  }
  else
  {
    $upQry="update tbl_qualification set qualification_name = '". $qualification."' where qualification_id = '".$hidden."'";
    if($Con->query($upQry))
    {
      ?>
      <script>
        alert("Updated Successfully");
        window.location="Qualification.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script>
        alert("Error");
        window.location="Qualification.php";
      </script>
      <?php
    }
  }
} 
 
// remove
if(isset($_GET['rid']))
{
  $remQry=" update tbl_qualification set qualification_status=1 where qualification_id='".$_GET['rid']."'";
  if($Con->query($remQry))   
  {
    ?>
    <script>
      alert("Removal Successfully");
      window.location="Qualification.php";
    </script> 	
    <?php
  }
}
	  
// edit
if(isset($_GET['eid']))
{
  $selQry="select * from tbl_qualification where qualification_id='".$_GET['eid']."'"; 
  $row=$Con->query($selQry);
  $data=$row->fetch_assoc();
		 
  $qualificationid = $data['qualification_id'];
  $qualificationname = $data['qualification_name'];
}
?>  

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Qualification</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center" class="mb-3"><h3>Qualification</h3></div>
  
  <table class="table table-bordered table-hover" style="width:50%; margin:auto;">
    <tr>
      <td>Qualification</td>
      <td>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php echo $qualificationid?>"/>
        <input type="text" name="txt_qualification" id="txt_qualification" 
               class="form-control" placeholder="e.g. BCA"
               value = "<?php echo $qualificationname?>" required/>
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
  <div align="center"><h3>Qualification List</h3></div>
  
  <table class="table table-bordered table-hover" style="width:70%; margin:auto;">
    <tr>
      <th>Sl.No</th>
      <th>Qualification</th>
      <th>Action</th>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_qualification where qualification_status=0 ORDER BY qualification_name ASC";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
      $i++;
    ?>
    <tr>
      <td><?php echo  $i ?></td>
      <td><?php echo $data['qualification_name']?></td>
      <td>        
        <a href="Qualification.php?rid=<?php echo $data['qualification_id']?>" class="btn btn-outline-danger btn-sm">Remove</a>
        <a href="Qualification.php?eid=<?php echo $data['qualification_id']?>" class="btn btn-outline-primary btn-sm">Edit</a>
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
