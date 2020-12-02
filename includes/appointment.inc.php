<?php
  if(isset($_POST["appointment-submit"])) {
    require "dbh.inc.php";

    $hour = $_POST['hour'];
    $gap = $_POST['gap'];
    $name = $_POST['name'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];

    if(empty($name) || empty($priority) || empty($description)) {
      header("Location: ../index.php?error=emptyfields");
      exit();
    } else {
          $sql = "INSERT INTO appointments".$_POST['index']." (hour, gap, name, priority, description) VALUES (?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "sssss", $hour, $gap, $name, $priority, $description);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php?appointment=success");
            exit();
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
    }
  } else {
    header("Location: ../index.php");
    exit();
  }
