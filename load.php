<?php
  $connect = mysqli_connect("localhost", "root", "", "loginsystem");

  $output = '<option value=""> Display doctors </option>';

  if(isset($_POST["location_id"]) && isset($_POST["specialization_id"])) {
  	if($_POST["location_id"] != '' && $_POST["specialization_id"] != '' ) {
  		$sql = "SELECT * FROM doctor WHERE locCode ='".$_POST["location_id"]."' AND specCode ='".$_POST["specialization_id"]."'";
  	} else {
  		$sql = "SELECT * FROM doctor";
  	}

  	$result = mysqli_query($connect, $sql);
  	while($row = mysqli_fetch_array($result)) {
      $output .= '<option value="'.$row["doctor_id"].'">'.$row["doctor_surname"].'</option>';
  	}

   	echo $output;
  }
 ?>
