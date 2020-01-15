<?php
$sql_con = mysqli_connect("localhost", "", "", "patient_details") or die("Error in connection");
$success = FALSE;

if(!empty($_REQUEST)) {
	$q_regn_num = $_REQUEST['regn_num'];	

if($q_regn_num) {		

	$res = mysqli_query($sql_con, "SELECT * FROM perma_details where regn_num='$q_regn_num'");
	$details = mysqli_fetch_array($res, MYSQLI_ASSOC);	

	$patient_name = $details['patient_name'];
	$regn_num = $details['regn_num'];
	$gender = $details['gender'];
	$age = $details['age'];
	$dob = $details['dob'];
	$address = $details['address'];
	$pincode = $details['pincode'];
	$phone = $details['phone'];
	$occupation = $details['occupation'];

if (isset($_REQUEST['disp_meds'])){
	
	$complaint = $_POST['complaint'];
	$prov_diag = $_POST['prov_diag'] or "";
	$disp_meds = $_POST['disp_meds'];
	$cons_fee = $_POST['cons_fee'] or 0;
	$disp_fee = $_POST['disp_fee'];

	mysqli_query($sql_con, "INSERT INTO visiting_details(regn_num, complaint, prov_diag, disp_meds, cons_fee, disp_fee) values ('$regn_num', '$complaint', '$prov_diag', '$disp_meds', '$cons_fee', '$disp_fee')") or die("Error inserting data: ".mysqli_error($sql_con));

	$success = TRUE;
	}
}
}
else {
	$patient_name = "";
	$regn_num = "";
	$gender = "";
	$age = "";
	$dob = "";
	$address = "";
	$pincode = "";
	$phone = "";
	$occupation = "";

}
?>