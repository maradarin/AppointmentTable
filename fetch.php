<?php


$connect = mysqli_connect("localhost", "root", "", "loginsystem");
$query = '';
//if( isset( $_POST['doctor'] ) ) $index = $_POST['doctor'];

$query = "SELECT * FROM appointments".$_POST['index']." ORDER BY gap";
$result = mysqli_query($connect, $query);
$output = array();

while($row = mysqli_fetch_assoc($result)) {
	$output[] = $row;
}

$sql = "SELECT * FROM appointments".$_POST['index']." WHERE confirmation='Confirmed'";
$res = mysqli_query($connect, $sql);


echo json_encode($output);

?>
