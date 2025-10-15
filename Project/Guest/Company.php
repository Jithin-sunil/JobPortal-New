<?php 
include("../Assets/Connection/Connection.php"); 

if(isset($_POST['btn_submit'])) {
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    $contact=$_POST['txt_contact'];
    $address=$_POST['txt_address'];
    $licnum=$_POST['txt_idnumber'];

    $logo=$_FILES['file_logo']['name'];
    $templogo=$_FILES['file_logo']['tmp_name'];
    move_uploaded_file($templogo,'../Assets/Files/Company_Registration/Logo/'.$logo);

    $license=$_FILES['file_license']['name'];
    $templicense=$_FILES['file_license']['tmp_name'];
    move_uploaded_file($templicense,'../Assets/Files/Company_Registration/License/'.$license);

    $password=$_POST['txt_password'];
    $companycategory=$_POST['sel_companycategory'];
    $place=$_POST['sel_place'];
    $companytype=$_POST['sel_companytype'];

    $insQry = "insert into tbl_company(company_name, company_email,company_contact, company_address, company_logo, company_license, place_id,companytype_id, companycategory_id, company_password,company_licensenumber,company_doj) 
    values('".$name."','".$email."','".$contact."','".$address."','".$logo."','".$license."','".$place."','".$companytype."','".$companycategory."','".$password."','".$licnum."',curdate())";

    if($Con->query($insQry)) {
        ?>
        <script>
        alert("Insertion Successfully");
        window.location="../index.php";
        </script>
        <?php 
    } else { 
        ?>
        <script>
        alert("Insertion Failed");
        window.location="Company.php";
        </script>
        <?php 
    } 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Company Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
        background-size: cover;
    }
    .registration-container {
        max-width: 850px;
        margin: 50px auto;
        background: rgba(255,255,255,0.92); /* transparent white card */
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        animation: fadeIn 1s ease-in-out;
    }
    .registration-container h3 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 700;
        color: #007bff;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .form-label {
        font-weight: 600;
        color: #333;
    }
    .form-control, .form-select {
        margin-bottom: 20px;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ddd;
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0px 0px 8px rgba(0,123,255,0.4);
    }
    textarea {
        resize: none;
    }
    .btn-primary {
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: bold;
        background: linear-gradient(to right, #007bff, #00c6ff);
        border: none;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: linear-gradient(to right, #0056b3, #007bff);
        transform: scale(1.05);
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>
</head>

<body>
<div class="container">
<div class="registration-container">
<h3>Company Registration</h3>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

    <div class="mb-3">
        <label for="txt_name" class="form-label">Name</label>
        <input type="text" name="txt_name" id="txt_name" class="form-control"
            minlength="3" maxlength="16"
            pattern="^[A-Z][a-zA-Z ]+$"
            title="Name must start with a capital letter and contain only letters and spaces"
            required />
    </div>

    <div class="mb-3">
        <label for="txt_address" class="form-label">Address</label>
        <textarea name="txt_address" id="txt_address" class="form-control" rows="5" required></textarea>
    </div>

  <div class="mb-3">
    <label for="sel_companycategory" class="form-label">Company Category</label>
    <select name="sel_companycategory" id="sel_companycategory" class="form-select" required>
        <option value="" disabled selected>-select companycategory-</option>
        <?php 
        $selQry="select * from tbl_companycategory where companycategory_status=0 ORDER BY companycategory_name ASC";
        $row=$Con->query($selQry);
        while($data=$row->fetch_assoc()) {
        ?>
            <option value ="<?php echo $data['companycategory_id']?>"><?php echo $data['companycategory_name'] ?></option>
        <?php } ?>
    </select>
</div>


    <div class="mb-3">
    <label for="txt_email" class="form-label">Email</label>
    <input type="email" 
           name="txt_email" 
           id="txt_email" 
           class="form-control" 
           placeholder="example@domain.com"
           required 
           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
           title="Please enter a valid email address (lowercase only, e.g., example@domain.com)" />  
</div>



    <div class="mb-3">
        <label for="txt_contact" class="form-label">Contact</label>
        <input type="tel" name="txt_contact" id="txt_contact" class="form-control"
        pattern="[6-9]{1}[0-9]{9}" 
        minlength="10" maxlength="10"
        title="10 digits starting with 6/7/8/9"
        required />
    </div>

    <div class="mb-3">
        <label for="txt_idnumber" class="form-label">License Identification Number</label>
        <input type="text" name="txt_idnumber" id="txt_idnumber" class="form-control"
            minlength="8" maxlength="16"
            pattern="[A-Z0-9]{8,16}"
            title="License number must be 8-16 characters (capital letters and numbers only)"
            required />
    </div>

    <div class="mb-3">
        <label for="file_license" class="form-label">Upload License (PDF)</label>
        <input type="file" name="file_license" id="file_license" class="form-control"
            accept="application/pdf" required />
    </div>
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
        <option value="">-select District-</option>
    </select>
</div>

<div class="mb-3">
    <label for="sel_place" class="form-label">Place</label>
    <select name="sel_place" id="sel_place" class="form-select" required>
        <option value="">-select place-</option>
    </select>
</div>

    <div class="mb-3">
        <label for="file_logo" class="form-label">Upload Logo (Image)</label>
        <input type="file" name="file_logo" id="file_logo" class="form-control"
            accept="image/*" required />
    </div>

    <div class="mb-3">
        <label for="sel_companytype" class="form-label">Company Type</label>
        <select name="sel_companytype" id="sel_companytype" class="form-select" required>
            <option>-select company type-</option>
            <?php 
            $selQry="select * from tbl_companytype where companytype_status=0 ORDER BY companytype_name ASC";
            $row=$Con->query($selQry);
            while($data=$row->fetch_assoc()) {
            ?>
                <option value ="<?php echo $data['companytype_id']?>"><?php echo $data['companytype_name']?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="txt_password" class="form-label">Password</label>
        <input type="password" name="txt_password" id="txt_password" class="form-control"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
            required />
    </div>

    <div class="text-center">
        <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary px-5" value="Submit" />
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
