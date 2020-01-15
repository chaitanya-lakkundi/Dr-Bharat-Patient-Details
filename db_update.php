<!--
Features:
1. Entry for New visit
2. Update existing perma details
-->
<?php include 'base_head.php'; ?>

<body>
  <div class="container">

    <form class="well form-horizontal" action="db_update.php" method="POST"  id="patient_details_form">
<fieldset>

<!-- Form Name -->
<legend><center>Add visiting entry</center>
<div class="row">
    <div class="col-md-4">
      <div class="input-group">
        <a href="index.php" class="btn btn-warning no-print">New Registration</a>
      </div>
    </div> 
    <div class="col-md-4">
      <div class="input-group">
        <a href="search.php" class="btn btn-warning no-print">Search</a>
      </div>
    </div>    
  </div>
</legend>
<?php require 'db_update.inc.php'; ?>
<div class="">
	<table class="table table-striped table-hover fixed">
  <!--<col width="20%"/>-->
    <tr>
      <th>
        Patient Name
      </th>
      <td>
        <?php echo $patient_name; ?>
      </td>
      <th>
        Registration Number
      </th>
      <td>
        <?php echo $regn_num; ?> 
        <input type="hidden" name="regn_num" value=<?php echo $regn_num; ?> />
      </td>
    </tr> 

    <tr>
      <th>
        Gender, Age
      </th>
      <td>
        <?php echo $gender; ?>        
        <?php $val = $age?(", ".$age." yr"):""; echo $val; ?>
      </td>
      
      <th>
        Address
      </th>
      <td>
        <?php echo $address," ",$pincode; ?>
      </td>
    </tr> 

    <tr>
      <th>
        Contact Number
      </th>
      <td>
      <?php echo $phone; ?>
      </td>
      <th>
        Occupation
      </th>
      <td>
      <?php echo $occupation; ?>
      </td>
    </tr>        
  </table>
</div>
<br/>
<div class="form-group">
<div class="row">

<div class="col-md-6">
  <label class="col-md-3 control-label">Complaint</label>
      <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <textarea rows="4" class="form-control" name="complaint" id="complaint" placeholder="Complaint" required="required"></textarea>
    </div>
</div>
</div>

<div class="col-md-6">
  <label class="col-md-3 control-label">Provisional Diagnosis</label>
      <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <textarea rows="4" class="form-control" name="prov_diag" id="prov_diag" placeholder="Diagnosis" ></textarea>
    </div>
</div>
</div>

</div>
</div>


<div class="row">
<div class="form-group">

<div class="col-md-6">
  <label class="col-md-3 control-label">Treatment / Dispensed medicines</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <textarea rows="4" class="form-control" name="disp_meds" placeholder="Medicines" required="required"></textarea>
    </div>
</div>
</div>

<div class="col-md-6">
  <div class="row">
  <label class="col-md-3 control-label">Consultation Fee</label>
   <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
  <input name="cons_fee" placeholder="Consultation Fee" class="form-control" type="text">
      </div>
    </div> 
    </div>
    <br/>
    <div class="row">
    <label class="col-md-3 control-label">Dispensary / Therapy fee</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil no-print"></i></span>
          <input name="disp_fee" placeholder="Dispensary / Therapy fee" class="form-control" required="required" type="text">          
  </div>
  </div>
    </div>
  </div>
  </div>

<br/>
<div class="row">
<div class="form-group">  
  <div class="col-md-offset-5 col-md-3">
    <button type="submit" id="submit" class="btn btn-info">Add new entry</button>
  </div>  
  
  <div class="col-md-3">
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
</div>
</fieldset>
</form>
</div>

<?php require 'base_tail.php'; ?>