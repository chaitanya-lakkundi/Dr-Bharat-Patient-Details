<?php include 'base_head.php' ?>
<?php
if (!empty($_GET)){
  if(isset($_GET['print'])) {
    echo "<script>window.print();</script>";
  }
}
?>

<body>
	<div class="container">
		<center><legend>DAATRI AYURVEDA CLINIC<br/>CASE SHEET</legend></center>
	</div>
	<?php require 'search.inc.php' ?>
	
</body>
<?php include 'base_tail.php' ?>