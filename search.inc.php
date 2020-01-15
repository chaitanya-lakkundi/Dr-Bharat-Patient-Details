<?php

function display_casesheet($details) {
	$regn_num = $details['Registration Number'];
	$patient_name = $details['Patient Name'];
	$age = $details['Age'];
	$gender = $details['Gender'];
	$address = $details['Address'];
	$occupation = $details['Occupation'];
	$photo_fqdn = $details['Photo FileName'];	
	echo "
	<p align='right' style='font-weight:bold;'>Regn. No. $regn_num</p>
	<p> ".strtoupper($patient_name)." </p> <img src='photos/$photo_fqdn' style='float:right; width:200px; height:170px;'>
	<p> $age yr / $gender </p>
	<p> Address: $address </p>
	<p> Occupation: $occupation </p>
	";
}

function display_one_array($details) {

	echo "<table class='table table-striped table-hover table-bordered'>";
	echo "<col width='15%'/>";
	echo "<col width='20%'/>";
	echo "<col width='45%'/>";
	foreach ($details as $key => $value) {
		
		echo "<tr> <td></td> <th>$key</th> <td>$value</td> </tr>";
	}
	echo "</table>";
}

function display_many_array($res, $headers) {	
	
	echo "<table class='table table-striped table-hover fixed table-bordered'>";
	if(array_count_values($headers) == 3) {
	echo "<col width='20%'/>";
	echo "<col width='40%'/>";
	echo "<col width='40%'/>";	
	}
	else {
		echo "<col width='20%'/>";
		echo "<col width='40%'/>";
		
	}

	echo "<tr>";
	foreach ($headers as $val) {
		echo "<th> $val </th>";
	}
	echo "</tr>";

	do{
		$details = mysqli_fetch_array($res, MYSQLI_NUM);
		echo "<tr>";		
		for ($i=0; $i < count($details); $i++) { 
			echo "<td> $details[$i] </td>";
		 } 
		echo "</tr>";
	}while(!empty($details));

	echo "</table>";	
}

$sql_con = mysqli_connect("localhost", "", "", "patient_details") or die("Error in connection");

$q_regn_num = FALSE;
$q_patient_name = FALSE;
$not_found = FALSE;

if(!empty($_GET)) {
	$q_regn_num = $_GET['regn_num'];
	$q_patient_name = $_GET['patient_name'];
	$q_option = $_GET['option'];
}

if($q_regn_num) {		

	$res = mysqli_query($sql_con, "SELECT patient_name as 'Patient Name',regn_num as 'Registration Number',gender as 'Gender',age as 'Age',dob as 'Date of Birth',address as 'Address',pincode as 'Pincode',phone as 'Contact Number',occupation as 'Occupation',photo_fqdn as 'Photo FileName' FROM perma_details where regn_num='$q_regn_num'");
	
	$details = mysqli_fetch_array($res, MYSQLI_ASSOC);
	$patient_name = $details['Patient Name'];
	if(mysqli_num_rows($res)) {
		if($q_option == 1 || $q_option == 3) {		
		display_one_array($details);
		}
	}
	else {
		echo "<strong>Regn Number not found</strong>";
		$not_found = TRUE;
	}
	$sql = "SELECT timestamp,complaint,disp_meds FROM `visiting_details` where regn_num='$q_regn_num'";
	$res = mysqli_query($sql_con, $sql);

	$headers = array('Date & Time','Complaint', 'Treatment');
	if(mysqli_num_rows($res) && $q_option >= 2) {	
		display_casesheet($details);	
		display_many_array($res, $headers);
	}
}

if($q_patient_name || ($q_patient_name && $not_found)){

	$sql = "SELECT patient_name, regn_num FROM perma_details where patient_name like \"%$q_patient_name%\"";
	$res = mysqli_query($sql_con, $sql);

	$headers = array('Patient Name', 'Registration Number');
	if(mysqli_num_rows($res) && $q_option >= 2) {		
		display_many_array($res, $headers);
	}
}
mysqli_close($sql_con);
?>