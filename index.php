<?php
// Start the session
session_start();
?>

<?php require 'db_regn.inc.php'; ?>
<?php require 'base_head.php'; ?>
<?php
if(isset($_POST['patient_photo'])) {  
    $data = $_POST['patient_photo'];
    $uri = substr($data,strpos($data,",")+1);
    $encodedData = str_replace(' ','+',$uri);
    $decodedData = base64_decode($encodedData);
    $_SESSION['patient_photo'] = $decodedData;
    $_SESSION['photo_taken'] = TRUE;
}
else {
  $decodedData = "";
  $_SESSION['photo_taken'] = FALSE;
}

?>

<body>
  <div class="container">

    <form class="well form-horizontal" action="index.php" method="POST"  id="patient_details_form">
<fieldset>

<!-- Form Name -->
<legend><center>Patient Registration</center>
  <div class="row no-print">
    <div class="col-md-1">
      <div class="input-group">
        <a href="search.php" class="btn btn-warning no-print">Search</a>        
      </div>      
    </div>
    <div style="font-size:14pt;">
      Info: If photo is needed, it must be <span style="color: red;">taken first</span>, before entering data
    </div>
  </div>
  <div class="row">    
    <div class="col-md-offset-3 col-md-6">
<?php
  if($success){
    echo '<div id="success_div" class="alert alert-success alert-dismissable">
          <p id="success_msg"><strong>Success!</strong>  Saved Details</p>
          <script>hideSuccessMsg();</script>
          </div>';
  }
?>  
  </div>
  </div>
</legend>

<!-- Text input-->
<div class="form-group">
  <div class="row">
    <div class="col-md-6">
      <label class="col-md-3 control-label">Patient Name</label>
      <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user no-print"></i></span>
  <input  name="patient_name" id="patient_name" placeholder="Patient Name" class="form-control" required="required" type="text">
  <a class="btn btn-info" href="camera.php">Take Photo</a>
  <?php if($_SESSION['photo_taken']) {echo "Photo Taken";} ?>
    </div>

  </div>
    </div>
    <div class="col-md-6">
      <label class="col-md-3 control-label" >Registration Number</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user no-print"></i></span>
  <input name="regn_num" id="regn_num" placeholder="Registration Number" class="form-control" required="required" type="text" value=<?php echo $new_regn_num; ?>>  
    </div>    
  </div>
  
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
  <div class="col-md-2">
    <label class="col-md-4 control-label col-md-offset-2">Gender</label>
  <div class="col-md-6">
    <div class="radio">
        <label>
          <input type="radio" name="gender" value="male" required="required" /> Male
      </label>
  </div>
  <div class="radio">
      <label>
          <input type="radio" name="gender" value="female" required="required" /> Female
        </label>
    </div>
  </div>
  </div>
  <div class="col-md-3">
    <div class="row">
    <label class="col-md-3 control-label">Age</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user no-print"></i></span>
    <input type="text" name="age" placeholder="Age" class="form-control" required="required"/>
    </div>
  </div>    
      </div>
      <div class="row">
      <label class="col-md-3 control-label">DOB</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user no-print"></i></span>
    <input type="date" name="dob" placeholder="dd/mm/yyyy" class="form-control""/>
    </div>
  </div>
      </div>
  </div>

<div class="col-md-7">
    <label class="col-md-4 control-label">Address</label>
    <div class="col-md-7 inputGroupContainer">    
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home no-print"></i></span>
  <textarea rows="4" class="form-control" name="address" placeholder="Address" required="required"></textarea>
    </div>
  </div>
  </div>
  </div>
</div>


<!-- Text input-->

<div class="form-group">
<div class="row">
  <div class="col-md-6">
  <label class="col-md-3 control-label">Pincode</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-globe no-print"></i></span>
  <input name="pincode" placeholder="Pincode" class="form-control" type="number">
    </div>
  </div>
  </div>
<div class="col-md-6">
<label class="col-md-3 control-label">Contact Number</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone no-print"></i></span>
  <input name="phone" placeholder="Contact Number" class="form-control" required="required" type="text">
    </div>
  </div>

</div>
</div>
</div>


<!-- Text input-->

<div class="form-group">
<div class="row">
  <div class="col-md-6">
  <label class="col-md-3 control-label">Occupation</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <input name="occupation" placeholder="Occupation" class="form-control" required="required" type="text">
    </div>
  </div>
  </div>
  <div class="col-md-6">
  <label class="col-md-3 control-label">Complaint</label>
      <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <textarea rows="4" class="form-control" name="complaint" id="complaint" placeholder="Complaint" required="required"></textarea>
    </div>
</div>
</div>

</div>
</div>

<div class="form-group">
<div class="row">
  <div class="col-md-6">
  <label class="col-md-3 control-label">Provisional Diagnosis</label>
      <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <textarea rows="4" class="form-control" name="prov_diag" id="prov_diag" placeholder="Diagnosis" ></textarea>
    </div>
</div>
</div>

  <div class="col-md-6">
  <label class="col-md-3 control-label">Dispensed medicines</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <textarea rows="4" class="form-control" name="disp_meds" placeholder="Medicines" required="required"></textarea>
    </div>
</div>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
  <div class="col-md-6">
  <label class="col-md-3 control-label">Consultation Fee</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <input name="cons_fee" placeholder="Consultation Fee" class="form-control" type="number">
    </div>
  </div>
  </div>
<div class="col-md-6">
<label class="col-md-3 control-label">Dispensary / Therapy Fee</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <input name="disp_fee" placeholder="Dispensary Fee" class="form-control" required="required" type="number">
    </div>
  </div>

</div>
</div>
</div>

<div class="row">
<div class="form-group">  
  <div class="col-md-offset-5 col-md-3">
    <button type="submit" id="submit" class="btn btn-info">Save Details</button>
  </div>  
  
  
</div>
</div>
</fieldset>
</form>
</div>
    </div><!-- /.container -->
<script src='js/jquery.min.js'></script>
<script src='js/bootstrap.min.js'></script>
<!--<script src='js/bootstrapvalidator.min.js'></script>
<script src="js/index.js"></script>-->
<script type="text/javascript">
document.getElementById("prov_diag").required = false;
</script>

</body>
</html>
