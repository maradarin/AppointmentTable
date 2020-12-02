<?php
//update.php
$connect = mysqli_connect("localhost", "root", "", "loginsystem");
$query = "
 UPDATE appointments".$_POST["index"]." SET ".$_POST["name"]." = '".$_POST["value"]."'
 WHERE id = '".$_POST["pk"]."'";
mysqli_query($connect, $query);

?>
