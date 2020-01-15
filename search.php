<?php include 'base_head.php'; ?>

<body>
  <div class="container">

    <form class="well form-horizontal" action="search.php" method="GET"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend class="no-print"><center>Patient Search</center>
<div class="row no-print">
    <div class="col-md-4">
      <div class="input-group">
        <a href="index.php" class="btn btn-warning no-print">New Registration</a>
      </div>
    </div> 
</div>
</legend>
<!-- Text input-->
<div class="form-group">
  <div class="row no-print">
    <div class="col-md-6">
      <label class="col-md-3 control-label">Patient Name</label>
      <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user no-print"></i></span>
  <input  name="patient_name" id="patient_name" placeholder="Patient Name" class="form-control" type="text" />
    </div>
  </div>
    </div>
    <div class="col-md-6">
      <label class="col-md-4 control-label" >Registration Number</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user no-print"></i></span>
  <input name="regn_num" id="regn_num" placeholder="Registration Number" class="form-control" type="text" />  
    </div>    
  </div>  
  </div>

  <div class="row"> 
  <div class="col-md-1">
  <br/>
  </div>
  </div>
  <input type="hidden" name="option" value="3" />
  <div class="row">  
    <center><button type="submit" class="btn btn-info">Search</button></center>
	</div>
  </fieldset>

</form>
  <div class="row">       
    <div class="col-md-12">
    <?php
      if(!empty($_GET) && $_GET['regn_num']) {
          $regn_num = $_GET['regn_num'];
          echo '
          <div class="col-md-6" align="center">          
            <a href="db_update.php?regn_num=';
            echo "$regn_num";
            echo '" class="btn btn-info no-print">Add visiting entry</a>
          </div>
          ';

          echo "
          <form action='case_sheet.php' method='GET' target='_blank'>
            <div class='col-md-6 no-print' align='center'>
            <span><i class='glyphicon glyphicon-print'></i>
              <button type='submit' class='btn btn-info'>Print</button>
            </span>
            </div>
            <input type='hidden' name='option' value='2' />
            <input type='hidden' name='regn_num' value='$regn_num' />
            <input type='hidden' name='patient_name' />
            <input type='hidden' name='print' value='print' />
          </form>
          ";
      }
    ?>
    </div>

  </div>
</div>
<br/>
  <div class="row">
    <div class="col-md-1">
    <br/>
    </div>

    <div class="col-md-10">
    <?php require 'search.inc.php'; ?>
    </div>
  </div>
</div>


</div>
</body>
</html>