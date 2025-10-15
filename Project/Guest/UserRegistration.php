<?php
 include("../Assets/Connection/Connection.php");
 if(isset($_POST['btn_submit']))
 {
   $name=$_POST['txt_name'];
   $email=$_POST['txt_email'];
   $contact=$_POST['txt_contact'];
   $address=$_POST['txt_address'];
   
   $idnumber=$_POST['txt_idproof'];
   
   $photo=$_FILES['file_photo']['name'];
   $tempphoto=$_FILES['file_photo']['tmp_name'];
   move_uploaded_file($tempphoto,'../Assets/Files/User_Registration/Photo/'.$photo);

   $idproof=$_FILES['file_idproof']['name'];
   $tempproof=$_FILES['file_idproof']['tmp_name'];
   move_uploaded_file($tempproof,'../Assets/Files/User_Registration/IDProof/'.$idproof);

   $gender=$_POST['rad_gender'];
   $dob=$_POST['dob_date'];
   $password=$_POST['txt_password'];
   $place=$_POST['sel_place'];
   
   $insQry="insert into tbl_user(user_name, user_email, user_contact, user_address, user_photo, user_gender, user_dob, place_id, user_password,user_idproofnumber,user_idproof,user_doj)values('".$name."','".$email."','".$contact."','".$address."','".$photo."','".$gender."','".$dob."','".$place."','".$password."','".$idnumber."','".$idproof."',curdate())";
    
	if($Con->query($insQry))
	{
		?>
   	<script>
		alert("Insertion Successfully");
		window.location="../UserRegistration.php";
		</script>
		
	   <?php	
	}
     else
	 {
		  ?>
		<script>
		alert("Insertion Failed");
		window.location="UserRegistration.php";
		</script> 
			<?php 
	 }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>User Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: url("https://images.unsplash.com/photo-1504384764586-bb4cdc1707b0?auto=format&fit=crop&w=1470&q=80") no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .overlay {
        background-color: rgba(0, 0, 0, 0.6);
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: -1;
    }

    .registration-card {
        max-width: 750px;
        margin: 50px auto;
        padding: 30px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        animation: fadeIn 1.2s ease-in-out;
    }

    .registration-card h3 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
        color: #0d6efd;
        letter-spacing: 1px;
    }

    .form-control, .form-select {
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 10px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        border: none;
        transition: 0.3s ease-in-out;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #6610f2, #0d6efd);
        transform: scale(1.05);
    }

    .btn-secondary {
        border-radius: 25px;
        padding: 10px 25px;
    }

    label {
        font-weight: 500;
    }

    textarea {
        resize: none;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
<div class="overlay"></div>

<div class="container">
    <div class="registration-card">
       <h3>User Registration</h3>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <!-- Name -->
  <div class="mb-3">
    <label for="txt_name" class="form-label">Name</label>
    <input type="text" name="txt_name" id="txt_name" class="form-control"
       minlength="3" maxlength="16"
       required 
       pattern="^[A-Z][a-zA-Z ]+$"
       title="Name must start with a capital letter and contain only letters and spaces"
        />

  </div>

  <!-- Address -->
  <div class="mb-3">
    <label for="txt_address" class="form-label">Address</label>
    <textarea name="txt_address" id="txt_address" class="form-control" rows="5" required></textarea>
  </div>

  <!-- DOB -->
  <div class="mb-3">
  <label for="dob_date" class="form-label">DOB</label>
  <input type="date" 
       name="dob_date" 
       id="dob_date" 
       class="form-control"
       min="1900-01-01"
       max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"
       required 
       onkeydown="return false;" />

</div>

  <!-- Gender -->
  <div class="mb-3">
    <label class="form-label">Gender</label><br />
    <div class="form-check form-check-inline">
      <input type="radio" name="rad_gender" value="Male" id="rad_gender_m" class="form-check-input" required />
      <label for="rad_gender_m" class="form-check-label">Male</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="radio" name="rad_gender" value="Female" id="rad_gender_f" class="form-check-input" />
      <label for="rad_gender_f" class="form-check-label">Female</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="radio" name="rad_gender" value="Others" id="rad_gender_o" class="form-check-input" />
      <label for="rad_gender_o" class="form-check-label">Others</label>
    </div>
  </div>

 <!-- Contact -->
      <label for="txt_contact" class="form-label">Contact</label>
      <input type="tel" name="txt_contact" id="txt_contact" class="form-control"
        pattern="[6-9]{1}[0-9]{9}" 
        minlength="10" maxlength="10"
        title="10 digits starting with 6/7/8/9"
        required />

  <!-- Email -->
  <div class="mb-3">
    <label for="txt_email" class="form-label">Email</label>
    <input type="email" 
           name="txt_email" 
           id="txt_email" 
           class="form-control" 
           placeholder="example@domain.com"
           required 
           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
           title="Please enter a valid email address (e.g., example@domain.com)" />
  </div>


  <!-- Photo -->
  <div class="mb-3">
    <label for="file_photo" class="form-label">Photo</label>
    <input type="file" name="file_photo" id="file_photo" class="form-control"
      accept="image/png, image/jpeg, image/jpg" required />
  </div>

  <!-- ID Proof Number -->
<div class="mb-3">
  <label for="txt_idproof" class="form-label">ID Proof Number</label>
  <input type="text" name="txt_idproof" id="txt_idproof" class="form-control"
    minlength="8" maxlength="16"
    pattern="[A-Za-z0-9]{8,16}"
    title="ID Proof must be 8-16 characters (letters and numbers only)"
    required />
</div>


  <!-- ID Proof photo -->
  <div class="mb-3">
    <label for="file_idproof" class="form-label">Upload ID Proof</label>
    <input type="file" name="file_idproof" id="file_idproof" class="form-control"
      accept="image/*,application/pdf" required />
  </div>

  <!-- State / District / Place -->
  <div class="mb-3">
    <label for="sel_state" class="form-label">State</label>
    <select name="sel_state" id="sel_state" class="form-select" onChange="getDistrict(this.value)" required>
      <option value="">-select state-</option>
      <?php
      $selQry="select * from tbl_state where state_status=0 ORDER BY state_name ASC";
      $row=$Con->query($selQry);
      while($data=$row->fetch_assoc()) {
      ?>
      <option value ="<?php echo $data['state_id']?>"><?php echo $data['state_name']?></option>
      <?php } ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="sel_district" class="form-label">District</label>
    <select name="sel_district" id="sel_district" class="form-select" onChange="getPlace(this.value)" required>
      <option value="">-select district-</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="sel_place" class="form-label">Place</label>
    <select name="sel_place" id="sel_place" class="form-select" required>
      <option value="">-select place-</option>
    </select>
  </div>

  <!-- Password -->
  <div class="mb-3">
    <label for="txt_password" class="form-label">Password</label>
    <input type="password" name="txt_password" id="txt_password" class="form-control"
      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
      title="Must contain at least one number, one uppercase, one lowercase, and minimum 8 characters"
      required />
  </div>

  <div class="text-center">
    <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
    <input type="reset" name="btn_clear" id="btn_clear" class="btn btn-secondary ms-2" value="Clear" />
  </div>
</form>

    </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getDistrict(sid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
      success: function (result) {
        $("#sel_district").html(result);
      }
    });
  }
  
  function getPlace(pid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?pid=" + pid,
      success: function (result) {
        $("#sel_place").html(result);
      }
    });
  }
</script>
</body>
</html>
