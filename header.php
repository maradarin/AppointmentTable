<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="description" content="This is an example of a meta description. This will often show up in search result.">
      <meta name=viewport content="width=device-width, initial-scale=1">
      <title></title>
      <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/signup.css">
      <link rel="stylesheet" href="css/appointment.css">
      <link rel="stylesheet" href="css/timetable.css">
      <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
      <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"-->
      <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

      <style>
      table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td, th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      tr:nth-child(even){background-color: #f2f2f2;}

      tr:hover {background-color: #ddd;}

      th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }

      td:last-child {
        text-align: center;
      }
      </style>

  </head>
  <body>
      <header>
        <a href="index.php">
          <img src="img/logo.jpg" alt="mmtuts logo">
        </a>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Portofolio</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
          <?php
            if(isset($_SESSION["userId"])) {
              echo '<form action="includes/logout.inc.php" method="post">
                      <button class="header-submit" type="submit" name="logout-submit">Logout</button>
                    </form>';
            } else {
              echo '<form action="includes/login.inc.php" method="post">
                      <input class="header-input" type="text" name="mailuid" placeholder="Username/E-mail...">
                      <input class="header-input" type="password" name="pwd" placeholder="Password">
                      <button class="header-submit" type="submit" name="login-submit">Login</button>
                    </form>
                    <a id="header-signup" href="signup.php">Signup</a>';
            }
           ?>


      </header>
  <!--/body>
</html-->
