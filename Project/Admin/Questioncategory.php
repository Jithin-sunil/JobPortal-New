<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$questioncategoryid="";
$questioncategoryname="";

if(isset($_POST['btn_submit']))
{
  $quescategory=$_POST['txt_quescategory'];
  $hidden=$_POST['txt_hidden'];
 
  if($hidden=="")
  {
    $insQry="insert into tbl_questioncategory(questioncategory_name)values('".$quescategory."')";
    if($Con->query($insQry))
    {
      ?>
      <script>
        alert("Insertion Successfully");
        window.location="Questioncategory.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script>
        alert("Insertion FAILED");
        window.location="Questioncategory.php";
      </script>
      <?php
    }
  }
}

// remove
if(isset($_GET['rid']))
{
  $remQry = "update tbl_questioncategory set questioncategory_status = 1 where questioncategory_id = '".$_GET['rid']."' ";	
  if($Con->query($remQry))
  {
    ?>
    <script>
      alert("Removed");
      window.location="Questioncategory.php";
    </script>
    <?php
  }
}
	  	
// edit
if(isset($_GET['eid']))
{
  $selQry="select * from tbl_questioncategory where questioncategory_id='".$_GET['eid']."'"; 
  $row=$Con->query($selQry);
  $data=$row->fetch_assoc();
		 
  $questioncategoryid = $data['questioncategory_id'];
  $questioncategoryname = $data['questioncategory_name'];
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Question Category</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center" class="mb-3">Question Category</div>

  <table class="table table-bordered table-hover" style="width:50%; margin:auto;">
    <tr>
      <td>Question Category</td>
      <td>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value ="<?php echo $questioncategoryid ?>"/>
        <input type="text" name="txt_quescategory" id="txt_quescategory" 
               class="form-control" placeholder="Enter Question Category"
               value ="<?php echo $questioncategoryname ?>" required/>
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
  <div align="center">Question Category List</div>

  <table class="table table-bordered table-hover" >
    <tr>
      <th>Sl.No</th>
      <th>Category Name</th>
      <th>Action</th>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_questioncategory where questioncategory_status=0 order by questioncategory_name ASC";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc())
    {
      $i++;	
    ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['questioncategory_name']?></td>
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
