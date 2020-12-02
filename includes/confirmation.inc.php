<?php
  if(isset($_POST["confirmation-submit"])) {
    require "dbh.inc.php";
    $name = $_POST['nume'];
    if(count($name) == 0) {
      header("Location: ../index.php?error=emptyfields");
      exit();
    } else {
        $sql_gap = "SELECT gap FROM appointments".$_POST['index']." WHERE id=".$name[0];
        $result_gap = mysqli_query($conn, $sql_gap);
        $row = mysqli_fetch_assoc($result_gap);
        $gap = $row['gap'];

        $sql_delete = "DELETE FROM appointments".$_POST['index']." WHERE id!=".$name[0]." AND gap='".$gap."'";

          if (!mysqli_query($conn, $sql_delete)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
          }

          $sql_update = "UPDATE appointments".$_POST['index']." SET confirmation='Confirmed' WHERE id=".$name[0];

          if(!mysqli_query($conn, $sql_update)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
          }

        header("Location: ../index.php?confirmation=success_".$name[0]."_".$gap."_");
        exit();
        mysqli_close($conn);
    }
  } else {
    header("Location: ../index.php");
    exit();
  }

  ?>
