<?php
    $functie = '';
    $toAdd = '';
    if(substr($email['emailUsers'], 0, 5) == "admin"){
      echo "<p> Este admin </p>";
      $functie = "admin";
    }
    elseif(strpos($email['emailUsers'], 'clinica') !== false) {
      echo "<p> Este doctor </p>";
      $functie = "doctor";
      include 'doctor.php';
    }
    else {
      echo "<p> Este muritor de rand </p>";
      $functie = "pacient";
      include 'pacient.php';
    }

 ?>

 <div id="wrapper">
   <table class="">
    <thead>
     <tr>
      <th width="10%"></th>
      <th width="10%">Ora</th>
      <th width="50%">Programare</th>
     </tr>
    </thead>
    <tbody id="employee_data">
    </tbody>
   </table>

   <div id="inscriere">
      <form action="includes/appointment.inc.php" method="post">
        <input type="hidden" id="index" name="index" value="">
        <label for="hour">Hour:</label><br>
        <input type="text" id="hour" name="hour" value="" readonly><br>
        <label for="gap">Interval:</label><br>
        <input type="text" id="gap" name="gap" value="" readonly><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value=""><br>
        <label for="priority">Priority:</label><br>
        <input type="text" id="priority" name="priority" value=""><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description" value=""><br><br>
        <input type="submit" name="appointment-submit" value="Submit">
      </form>
    </div>
  </div>



<script type="text/javascript" language="javascript" >

$(".doctor").change(function(){

  var gap = ['07:00-07:20', '07:20-07:40', '07:40-08:00',
             '08:00-08:20', '08:20-08:40', '08:40-09:00',
             '09:00-09:20', '09:20-09:40', '09:40-10:00',
             '10:00-10:20', '10:20-10:40', '10:40-11:00',
             '11:00-11:20', '11:20-11:40', '11:40-12:00'];
  var hour = ['07:00 - 08:00', '08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00'];
  var sel = document.getElementById("doctor");
  var index = sel.options[sel.selectedIndex].value;
  alert(index);

  function build_table() {
    $.ajax({
     url:"fetch.php",
     method:"POST",
     data: {index: index},
     dataType:"json",
     success: function(data) {
      $('#employee_data').empty();
      var count = 0;

      // structura

      for(var i = 0; i < gap.length; i++) {
        if(i%3==0){
          var html_data = '<tr><td rowspan="3">'+hour[count++]+'</td><td>'+gap[i]+'</td>';
        } else {
          var html_data = '<tr><td>'+gap[i]+'</td>';
        }
        html_data += '<td data-name="details" data-type="text" data-pk="'+gap[i]+'" class = "appointment" id="'+gap[i]+'"><form id="'+gap[i]+'_form" action="includes/confirmation.inc.php" method="post"><input type="hidden" id="index_doctor" name="index" value="'+index+'"></form></td></tr>';
        $('#employee_data').append(html_data);
}

      // formular confirmare pt doctor; enumerare simpla pt pacient
      <?php
        if($functie == "doctor") {
      ?>
      var id = "";
      for(var i = 0; i < data.length; i++) {

        if(id!=data[i].gap) {
          if(id!="") document.getElementById(id+"_form").innerHTML += '<input type="submit" id="'+id+'_confirm" name="confirmation-submit" value="Confirm">';
          id = data[i].gap;
        }
        document.getElementById(id+"_form").innerHTML += (
                                                  '<input type="checkbox" id="'+data[i].id+'_pacient" name="nume[]" value="'+data[i].id+'"><label for="nume">'+data[i].name+"; "+data[i].priority+"; "+data[i].description+'</label><br>');
      }
      document.getElementById(id+"_form").innerHTML += '<input type="submit" id="'+id+'_confirm" name="confirmation-submit" value="Confirm">';
      document.getElementById('index_doctor').value = String(index);

      for(var i=0; i<data.length; i++) {
        if(data[i].confirmation == "Confirmed") {
          document.getElementById(data[i].id+"_pacient").style.display = "none";
          document.getElementById(data[i].gap+"_confirm").style.display = "none";
          }
      }
      <?php
        } else {
      ?>

      for(var i = 0; i < data.length; i++) {
        var id = data[i].gap;
        if(data[i].confirmation == "Confirmed") document.getElementById(id).classList.add("confirmed");
        document.getElementById(id).innerHTML += (data[i].name+'<br>');
      }
      <?php
        }
      ?>

      // formular pt pacient

      var celule = document.getElementsByClassName("appointment");
      alert(celule.length);
      //console.log(celule.length);
      <?php
        if($functie == "pacient") {
      ?>
      for(let i=0; i<celule.length; i++) {
        if(!celule[i].classList.contains("confirmed")) {
          celule[i].addEventListener('click', function() {

            var form = document.getElementById('inscriere');
            //form.style.visibility = "hidden";
            if(form.style.visibility == "hidden") {
              form.style.visibility = "visible";

              document.getElementById('index').value = String(index);
              document.getElementById('gap').value = String(gap[i]);
              document.getElementById('hour').value = String(hour[Math.floor(i/3)]);
            } else {form.style.visibility = "hidden";}
          })
        }
      }
      <?php } ?>
    }
  })
}

 build_table();

});
</script>
