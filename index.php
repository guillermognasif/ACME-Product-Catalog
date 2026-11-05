<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Acme</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Galindo&display=swap" rel="stylesheet">

	</head>
	<body>
		<?php
		session_start();
		include('includes/functions.php');
		include('includes/hashing.php');
		
		$conn = include('includes/db_connect.php');
		$sql = "SELECT * FROM user";
		$results = mysqli_query($conn, $sql);
		$user=$pass=$msg="";
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') //check if it has been submited
		{
			if (isset($_POST['user'])) $user = $_POST['user']; //retrieving the user and sticking it into the variable
			if (isset($_POST['pass'])) $pass = $_POST['pass']; //retrieving the pass and sticking it into the variable
			
			while($text = mysqli_fetch_array($results,MYSQLI_ASSOC))
			{
				$hashpass = hashing($user,$pass); 
				$dbuser = $text['username']; //adding each iteration of the array to the user variable to compare later
				$dbpass = $text['password'];
				if ((($user==$dbuser) && ($hashpass==$dbpass) && !isset($_SESSION['granted'])))//checks the user and pass are correct combo
				{	
					$_SESSION['granted'] = true;
					$_SESSION['user_id'] = $text['id'];
					$_SESSION['username'] = $user;
					break;
				}
				
				if (!isGranted())
				{
				$msg = 'Incorrect Username or Password';	
				}	
			}
		
		}
		else if (!isset($_SESSION['granted'])) 
			{
			$msg = 'Welcome';
			}
		?>
		
		<?php if (!isset($_SESSION['granted']))://if not granted, keep asking for user and pass?>
		<?php 
				include('includes/nav.php');?>
				<form id="formStyle" action="."method="POST">
					<h1><?php echo $msg; ?></h1>
					<div class="container">
					<input name="user" placeholder="Username" > 
					<input name="pass" type=Password placeholder="Password" > 
					</div>
					<button type="submit" name="submit">Login</button>
					<a href="index.php" class="reset-link">Reset</a>
					<a href="create-account.php" class="reset-link">Create Account</a>
				</form>
		<?php 
			else : //else granted ?>
		<?php include('includes/nav.php');?>
		<div class="welcome-form-container">
		<h1 class="welcome-msg"> Welcome to our ACME store </h1>
		<h2>Overview</h2>
		<p>Welcome to the world of ACME — the iconic fictional company made famous by classic cartoons like Looney Tunes. Known for producing all sorts of wild and unpredictable gadgets, ACME is the go-to brand for characters like Wile E. Coyote in his endless chase of the Road Runner. Whether it’s rockets, traps, or strange contraptions, ACME products are always entertaining (and usually backfire). This site is a fun tribute to that chaotic cartoon legacy — where imagination meets slapstick!</p>
		<h2>Our History</h2>
		<p>Founded in the heart of the desert in 1947, ACME Supply Co. began as a small family-run business dedicated to helping inventors and dreamers bring their wildest ideas to life. Our first product, the Spring-Powered Anvil Launcher, was a hit among cartoon enthusiasts and desert coyotes alike. Over the decades, we’ve expanded our catalog to include everything from rocket skates to portable holes — all proudly unpredictable and explosively imaginative. Today, we continue the tradition of delivering top-tier ACME products to customers who value creativity, chaos, and a bit of cartoon charm in everything they do.</p>
		<img src="img/indexImg.png" alt="ACME Logo" id="acme-logo">
		<a href="catalog.php" class="fun-button">Check Our Products</a>
		<input type="hidden" name="user" value="<?php echo($user); //keeping track of usre and pass so when the website refreshes it keeps running under the same ones ?>">
		<input type="hidden" name="pass" value="<?php echo($pass); ?>">
		<?php endif; ?>
	</body>
</html>