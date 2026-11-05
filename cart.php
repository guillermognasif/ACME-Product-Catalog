<?php
session_start();
include_once('includes/db_connect.php');
include('includes/functions.php');
include_once('includes/nav.php');
include_once('includes/table_printing.php');
$placedOrder = false;
if (isset($_POST['update']))
{
	for ($x = count($_SESSION['quantity']) - 1; $x >= 0; $x--) { 
    $qtyID = 'qty-' . $x;
    $newQty = (int)$_POST[$qtyID];

    if ($newQty <= 0) {
        unset($_SESSION['quantity'][$x]);
        unset($_SESSION['product-id'][$x]);
        unset($_SESSION['price'][$x]);
        unset($_SESSION['pName'][$x]);
    } else {
        $_SESSION['quantity'][$x] = $newQty;
    }
}

$_SESSION['quantity']  = array_values($_SESSION['quantity']); // Reindex arrays so keys go back to 0,1,2...
$_SESSION['product-id'] = array_values($_SESSION['product-id']);
$_SESSION['price']     = array_values($_SESSION['price']);
$_SESSION['pName']     = array_values($_SESSION['pName']);
}
if (isset($_POST['place']))
{
	echo '<div class="container">';
	echo '<h1>Thanks for shopping with us!</h1>';
	$placedOrder=true;
	echo '<h1>You have ordered: </h1>';
	costumer_receipt(); //showing the users selection
	echo '</div>';
	unset($_SESSION['product-id']); //unsetting all the data from the session
	unset($_SESSION['quantity']);
	unset($_SESSION['price']);
	unset($_SESSION['pName']);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Shopping Cart</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Galindo&display=swap" rel="stylesheet">
	</head>
	<body>
	<?php 
	if (isset($_SESSION['granted']))
	{
	
		if (!$placedOrder)
		{
			table_printing();
		}
	}
	else 
	{
		echo '<div id="formStyle">';
		echo '<h1>Please Log In to View Cart</h1>';
		echo '<a href="index.php" class="reset-link" >Click here to log in</a>';
		echo '</div>';
	}
			?>
	
	</body>
</html>