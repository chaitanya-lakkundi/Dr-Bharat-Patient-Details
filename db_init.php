<?php

$sql_con = mysqli_connect("localhost", "", "", "patient_details") or die("Error in connection");

mysqli_query($sql_con, "CREATE DATABASE IF NOT EXISTS `patient_details`; USE `patient_details`; ");

$sql = "CREATE TABLE IF NOT EXISTS `perma1_details` (
  `patient_name` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `regn_num` int(11) NOT NULL AUTO_INCREMENT,
  `gender` text NOT NULL,
  `age` int(11) NOT NULL,
  `dob` text,
  `address` varchar(1024) NOT NULL,
  `pincode` text NOT NULL,
  `phone` varchar(13) NOT NULL,
  `occupation` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_fqdn` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`regn_num`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
";

mysqli_query($sql_con, $sql) or die("Couldn't create table perma_details");

$sql = "CREATE TABLE IF NOT EXISTS `visiting_details` (
  `serial_num` int(11) NOT NULL AUTO_INCREMENT,
  `regn_num` int(11) NOT NULL,
  `complaint` varchar(1024) NOT NULL,
  `prov_diag` varchar(1024) DEFAULT NULL,
  `disp_meds` varchar(1024) NOT NULL,
  `cons_fee` float DEFAULT NULL,
  `disp_fee` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`serial_num`),
  KEY `regn_num` (`regn_num`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";

mysqli_query($sql_con, $sql) or die("Couldn't create table visiting_details");;

$sql = "CREATE TABLE IF NOT EXISTS `settings` (
  `regn_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

mysqli_query($sql_con, $sql) or die("Couldn't create table settings");

$sql = "
CREATE TRIGGER IF NOT EXISTS `update_regn_count` BEFORE INSERT ON `perma_details`
 FOR EACH ROW UPDATE settings SET regn_count=regn_count+1;
";

mysqli_query($sql_con, $sql) or die("Couldn't create trigger");

mysqli_close($sql_con);

echo "<h3>Successfully created databases and tables</h3>";
?>