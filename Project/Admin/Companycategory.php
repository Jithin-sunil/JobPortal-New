<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
$campcatid = "";
$campcatname = "";
if(isset($_POST['btn_submit']))
{
  $companycategory=$_POST['txt_companycategory'];
  $hidden = $_POST['txt_hidden'];
   
    if($hidden=="")
	{
  $insQry = "insert into tbl_companycategory(companycategory_name) values('".$companycategory."')";	
  if($Con->query($insQry))
  {
	?>
    <script>
	  alert("Insertion Successfully");
	  window.location="Companycategory.php";
	</script>
    <?php 
    }
	else
	{
	 ?>
      <script>
	  alert("Insertion failed");
	  window.location="Companycategory.php";
	</script>
        
	<?php	
	}
  }
  else
  {
   $upQry="update tbl_companycategory set companycategory_name = '".$companycategory."' where companycategory_id = '".$hidden."' ";
   if($Con->query($upQry))
   { 
   echo $upQry;
   ?>
    
         <script>
			 alert("Updated Successfully");
			  window.location="Companycategory.php";
		    </script>
	      <?php
   
    }
	 else
	  {
		 ?>
        <script>
		alert("Error");
		window.location="Companycategory.php";
		</script>
		<?php
	 }
	}
  }

 //remove
if(isset($_GET['rid']))
{
 $remQry=" update tbl_companycategory set companycategory_status=1 where companycategory_id='".$_GET['rid']."'";
if($Con->query($remQry))   
  {
	  
     ?>
      <script>
	  alert("removal Successfully");
	  window.location="Companycategory.php";
	  </script> 	
      <?php
	
  }
}


//edit
  
 if(isset($_GET['eid']))
	  {
		 $selQry="select * from tbl_companycategory where companycategory_id='".$_GET['eid']."'"; 
		 $row=$Con->query($selQry);
		 $data=$row->fetch_assoc();
		 
		 $campcatid = $data['companycategory_id'];
		 $campcatname = $data['companycategory_name'];
		 
	  }
	  ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company Category</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<div align="center">
<h3>Company Category</h3>
<table width="200" border="1" class="table table-bordered table-hover">
  <tr>
    <td>Company Category</td>
    <td><label for="txt_companycategory"></label>
     <input type="hidden" name="txt_hidden" id="txt_hidden" value = "<?php  echo $campcatid?>"/>
      <input type="text" name="txt_companycategory" class="form-control" id="txt_companycategory" value = "<?php  echo $campcatname?>" required/>
    </td>
  </tr>
  <tr>
    <td height="26" colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-outline-primary"/>
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<h3>Company Category List</h3>
<table width="200" border="1" class="table table-bordered table-hover">
  <tr>
    <td>Sl.No</td>
    <td>Company Category</td>
    <td>Action</td>
  </tr>
  <?php
   $i=0;
   $selQry="select * from tbl_companycategory where companycategory_status=0 ORDER BY
   companycategory_name ASC";
   $row=$Con->query($selQry);
   while($data=$row->fetch_assoc())
   {
	   $i++;
  
   
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $data['companycategory_name']?></td>
    <td>
     <a href = "Companycategory.php?rid=<?php echo $data['companycategory_id']?>" class="btn btn-outline-danger btn-sm">remove
     </a>
     <a href = "Companycategory.php?eid=<?php echo $data['companycategory_id']?>" class="btn btn-outline-primary btn-sm">edit
     </a>
    </td>
  </tr>
   <?php
   }
  ?>
</table>
</div>
</form>
</body>
</html>


<?php 
include("Footer.php");
?>