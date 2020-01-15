<?php

$sql_con = mysqli_connect("localhost", "", "", "patient_details") or die("Error in connection");

if(isset($_POST['patient_name'])) {
  
  $patient_name = $_POST['patient_name'];
  $regn_num = $_POST['regn_num'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $dob = $_POST['dob'] or NULL;
  $address = $_POST['address'];
  $pincode = $_POST['pincode'];
  $phone = $_POST['phone'];
  $occupation = $_POST['occupation'];
  $complaint = $_POST['complaint'];
  $prov_diag = $_POST['prov_diag'] or "";
  $disp_meds = $_POST['disp_meds'];
  $cons_fee = $_POST['cons_fee'] or 0;
  $disp_fee = $_POST['disp_fee'];  
  $photo_fqdn = "";

  if($_SESSION['photo_taken']) {
    $cur_dir = getcwd();    
    chdir("photos");
    $photo_fqdn = "$regn_num"."_"."$patient_name".".png";    
    file_put_contents($photo_fqdn, $_SESSION['patient_photo']);
    chdir($cur_dir);
    $_SESSION['photo_taken'] = FALSE;
  }

  mysqli_query($sql_con, "INSERT INTO perma_details(patient_name,regn_num,gender,age,dob,address,pincode,phone,occupation,photo_fqdn) values ('$patient_name','$regn_num','$gender','$age','$dob','$address','$pincode','$phone','$occupation','$photo_fqdn')") or die("Error inserting data: ".mysqli_error($sql_con));

  mysqli_query($sql_con, "INSERT INTO visiting_details(regn_num, complaint, prov_diag, disp_meds, cons_fee, disp_fee) values ('$regn_num', '$complaint', '$prov_diag', '$disp_meds', '$cons_fee', '$disp_fee')") or die("Error inserting data: ".mysqli_error($sql_con));

  $success = TRUE;
  $res = mysqli_query($sql_con, "SELECT regn_count from settings");
  $new_regn_num = mysqli_fetch_array($res, MYSQLI_NUM)[0] + 1 ;
}
else {

  $res = mysqli_query($sql_con, "SELECT regn_count from settings");
  $new_regn_num = mysqli_fetch_array($res, MYSQLI_NUM)[0] + 1 ;  
  $success = FALSE;
}
mysqli_close($sql_con);
?>