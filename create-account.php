<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Create Account</title>
		<script defer src="js/script.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Galindo&display=swap" rel="stylesheet">
	</head>
	<body>
		<?php 
		$user=$pass=$vPass=$password= $passMsg = "";
		$accountCreated = false;
		$msg="Sign Up";
		session_start();
		include('includes/functions.php');
		include('includes/nav.php');
		include('includes/hashing.php');
		$conn = include('includes/db_connect.php');
		?>
		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')//submit?
		{
			if (!$accountCreated) 
			{
				$user = $_POST['user'];
				$pass = $_POST['pass'];
				$vPass = $_POST['vPass'];
			}
			else $user = $pass = $vPass = '';

			if (isset($_POST['user'])) $user = $_POST['user']; 
			if (isset($_POST['pass'])) $pass = $_POST['pass'];
			if (isset($_POST['vPass'])) $vPass = $_POST['vPass']; //verify password variable
			if (!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['vPass'])) //before anything check it isnt empty
			{
			
				$sql = 'SELECT * FROM user WHERE username = "'.$user.'";'; //check there is a user with the same username in the db
				$userResults = mysqli_query($conn, $sql);
				if (mysqli_num_rows($userResults)>0) //if the result of the query above has a row then user exists
				{
					$msg = "Username Already Exists";
				}
				else // else add to db
				{
					$msg = "Thanks for Signing Up!";
					$password = hashing($user,$pass); //hash with user and pass
					$insert = 'INSERT INTO user (username,password) VALUES ("'.$user.'","'.$password.'");'; //insert sql command
					mysqli_query($conn, $insert);
					mysqli_close($conn);
					$accountCreated=true;//account created
				}
			}
		}
		else 
		{
			$msg="Sign Up";
		}
		?>
		<?php 
		if (!$accountCreated): //if account hasnt been created yet?>
			<form id="formStyle" method="POST">
				<h1><?php echo $msg; ?></h1>
				<div class="container">
					<input name="user" placeholder="Username" value="<?php echo $user ?>"> 
					<input name="pass" id="pw" type="password" placeholder="Password" value="<?php echo $pass ?>"> 
					<input name="vPass" id="vpw" type="password" placeholder="Verify Password" value="<?php echo $vPass ?>">
				</div>
				<button id="main-button" type="submit" name="submit" disabled >Create Account</button>
				<button type="button" onclick="window.location.href='index.php'">Log In</button>
				<a href="create-account.php" class="reset-link">Reset</a>
				<p id="msg"><?php echo $passMsg; ?></p>
			</form>
			
			
		<?php else: ?>
		  <div class="container2">
			<h1><?php echo $msg; ?></h1>
			<p><a href="index.php">Click here to log in</a></p>
		  </div>
		<?php endif; ?>
	</body>
</html>