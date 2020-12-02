<?php require "header.php"; ?>

	<main>
       <h1>Signup</h1>
			 <?php
			 		if(isset($_GET["error"])) {
						if($_GET["error"] == "emptyfields") {
							echo '<p class="error"> Fill in all fields! </p>';
						} elseif ($_GET["error"] == "invaliduidmail") {
							echo '<p class="error"> Invalid username and e-mail! </p>';
						} elseif ($_GET["error"] == "invaliduid") {
							echo '<p class="error"> Invalid username! </p>';
						} elseif ($_GET["error"] == "invalidmail") {
							echo '<p class="error"> Invalid mail! </p>';
						} elseif ($_GET["error"] == "passwordcheck") {
							echo '<p class="error"> Passwords do not match! </p>';
						} elseif ($_GET["error"] == "usertaken") {
							echo '<p class="error"> Username is already taken! </p>';
						}
					} elseif(isset($_GET["signup"]) == "success") {
							echo '<p class="success"> Signup successful! </p>';
					}
			  ?>
       <form id="signup-form" action="includes/signup.inc.php" method="post">
          <input class="signup-input" type="text" name="uid" placeholder="Username">
          <input class="signup-input" type="text" name="mail" placeholder="E-mail">
          <input class="signup-input" type="password" name="pwd" placeholder="Password">
          <input class="signup-input" type="password" name="pwd-repeat" placeholder="Repeat Password">
          <button class="signup-submit" type="submit" name="signup-submit">Signup</button>
       </form>
	</main>

	<?php require "footer.php"; ?>
