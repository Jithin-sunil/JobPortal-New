<?php
include("../Assets/Connection/Connection.php");
include("Header.php");

$technicalskillid = "";
$technicalskillname = "";

if (isset($_POST['btn_submit'])) {
    $technicalskill = $_POST['txt_technicalskill'];
    $hidden = $_POST['txt_hidden'];

    if ($hidden == "") {
        $insQry = "insert into tbl_technicalskill(technicalskill_name) values('" . $technicalskill . "')";
        if ($Con->query($insQry)) {
            ?>
            <script>
            alert("Insertion Successfully");
            window.location="Technicalskill.php";
            </script>
            <?php
        } else {
            echo "Error";
        }
    } else {
        $upQry = "update tbl_technicalskill set technicalskill_name = '" . $technicalskill . "' where technicalskill_id = '" . $hidden . "'";
        if ($Con->query($upQry)) {
            ?>
            <script>
            alert("Updation Successfully");
            window.location="Technicalskill.php";
            </script>
            <?php
        } else {
            echo "Error";
        }
    }
}

// remove
if (isset($_GET['rid'])) {
    $remQry = "update tbl_technicalskill set technicalskill_status=1 where technicalskill_id='" . $_GET['rid'] . "'";
    if ($Con->query($remQry)) {
        ?>
        <script>
        alert("Removal Successfully");
        window.location="Technicalskill.php";
        </script>
        <?php
    }
}

// edit
if (isset($_GET['eid'])) {
    $selQry = "select * from tbl_technicalskill where technicalskill_id='" . $_GET['eid'] . "'";
    $row = $Con->query($selQry);
    $data = $row->fetch_assoc();

    $technicalskillid = $data['technicalskill_id'];
    $technicalskillname = $data['technicalskill_name'];
}
?>

<div align="center">Technical Skill</div>
<form action="" method="post">
  <table class="table table-bordered table-hover">
    <tr>
      <td>Technical Skill</td>
      <td>
        <input type="hidden" name="txt_hidden" value="<?php echo $technicalskillid ?>" />
        <input type="text" name="txt_technicalskill" id="txt_technicalskill" 
               class="form-control" placeholder="Enter Technical Skill"
               value="<?php echo $technicalskillname ?>" required />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-outline-primary"/>
        <input type="reset" name="btn_clear" id="btn_clear" value="Clear" class="btn btn-outline-danger"/>
      </td>
    </tr>
  </table>

  <br>
  <div align="center">Technical Skill List</div>
  <table class="table table-bordered table-hover">
      <tr>
        <th>Sl.No</th>
        <th>Technical Skill</th>
        <th>Action</th>
      </tr>
    
    <tbody>
    <?php
    $i=0;
    $selQry="select * from tbl_technicalskill where technicalskill_status=0 ORDER BY technicalskill_name ASC";
    $row=$Con->query($selQry);
    while($data=$row->fetch_assoc()) {
        $i++;
    ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['technicalskill_name'] ?></td>
        <td>
          <a href="Technicalskill.php?eid=<?php echo $data['technicalskill_id'] ?>" class="btn btn-outline-primary">Edit</a>
          <a href="Technicalskill.php?rid=<?php echo $data['technicalskill_id'] ?>" class="btn btn-outline-danger"
             onclick="return confirm('Are you sure you want to remove this skill?')">Remove</a>
        </td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>
</form>

<?php 
   include("Footer.php"); 
?>
