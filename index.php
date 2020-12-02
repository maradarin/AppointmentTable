<?php
  require "header.php";

  $connect = mysqli_connect("localhost", "root", "", "loginsystem");

	function fill_select($connect, $name) {
		$output = '';
		$sql = "SELECT * FROM ".$name;
		$result = mysqli_query($connect, $sql);

		while( $row = mysqli_fetch_array($result)) {
      $output .='<option value="'.$row[$name."_id"].'">'.$row[$name."_name"];
      if($name == "doctor") {
			  $output .=$row[$name."_surname"].'</option>';
    } else {
        $output .='</option>';
      }
		}

		return $output;
	}
 ?>

 <main>

   <h3>
     <select name="location" id="location">
       <option value=""> Show all locations </option>
       <?php
          $name = "location";
          echo fill_select($connect, $name);
        ?>
     </select>

     <select name="specialization" id="specialization">
       <option value=""> Show all specializations </option>
       <?php
          $name = "specialization";
          echo fill_select($connect, $name);
        ?>
     </select>

     <form action="fetch.php" method="post">
     <select name="doctor" id="doctor" class="doctor">
       <option value=""> Display doctors </option>
       <?php
          $name = "doctor";
          echo fill_select($connect, $name);
       ?>
     </select>
   </form>
   </h3>


	  <?php
         if(isset($_SESSION["userId"])) {
           $validId = mysqli_real_escape_string($connect, $_SESSION['userId']);
           $email = mysqli_fetch_array(mysqli_query($connect, "SELECT emailUsers from users where idUsers='$validId'"));
           //echo "<p>Result is: </p>".$email['emailUsers'];
           require "appointment.php";

         } else {
           echo "<p>You need to be logged in to see the appointments chart!</p>";
      }
    ?>

 </main>

 <?php
  require "footer.php";
  ?>

  <script>

 $(document).ready(function() {
   $("#location, #specialization").change(function() {

 	var location_id  = $('#location').val();
  var specialization_id = $('#specialization').val();
  if(location_id && specialization_id) {
     	$.ajax({
     		url: "load.php",
     		method: "POST",
     		data: {location_id: location_id, specialization_id: specialization_id},
     		success:function(data) {
     			$('#doctor').html(data);
          //alert("ok");
     		}
     	});
    }
 	});
 });

 </script>


<!-- tabelul nu e vizibil pt cei nelogati - ok
     pacientii pot doar sa vizualizeze tabelul si sa completeze - ok
     doctorii pot confirma sau anula sugestia de programare a pacientului - ok

     TO DO:
     tabelul e colorat corespunzator pt pacienti si doctori
     pacient1 nu poate vedea pacient2
   -->
