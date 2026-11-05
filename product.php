<?php 
	session_start();
	include_once('includes/db_connect.php');
	include('includes/functions.php');
	include_once('includes/nav.php');
	$product = '';
	$pName = '';
	$pDescription = '';
	$imagePath = '';
	$price = '';
	if (isset($_GET['id']) && !empty($_GET['id']))
	{
		$sql = 'SELECT * FROM product WHERE ID = '.$_GET['id'];
		
		$results = mysqli_query($conn,$sql);
		
		$product = '';
		while ($row = mysqli_fetch_array($results,MYSQLI_ASSOC))
		{
			$product .= '<h2>'.$row['name'].'</h2>';
			$pDescription .= '<p>'.$row['description'].'<p>';
			$imagePath = $row['image'];
			
		}
	}
	
	if (isset($_POST['add-to-cart']))
	{
		if (isset($_SESSION['granted']))
		{
				
			$postId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
			$qty    = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
			
			$sql1 = 'SELECT * FROM product WHERE id = '.$_POST['id'];
			$results1 = mysqli_query($conn,$sql1);
			$price = '';
			while ($row = mysqli_fetch_array($results1,MYSQLI_ASSOC))
			{
				$price = $row['price'];
				$pName = $row['name'];
			}
			
			if(!isset($_SESSION['product-id']))
			{
				$_SESSION['product-id'] = array();
				$_SESSION['quantity'] = array();
				$_SESSION['price'] = array();
				$_SESSION['pName'] = array();
			}
			
			$idx = array_search($postId, $_SESSION['product-id']);
			if ($idx !== false) 
			{
				$_SESSION['quantity'][$idx] += $qty;
			} 
			else 
			{
				$_SESSION['product-id'][] = $postId;
				$_SESSION['quantity'][]   = $qty;
				$_SESSION['price'][]      = $price;
				$_SESSION['pName'][]      = $pName;
			}
			
			header('location: catalog.php');
			exit;
		}
		else 
		{
			header('location: cart.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Product</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Galindo&display=swap" rel="stylesheet">
	</head>
	<body>
	<form id="formStyle" method="POST">
	<?php echo $product; 
		  echo $pDescription;
		  ?>
	<img src="<?php echo $imagePath?>" id="acme-logo">
	
	
	<div class="container">
		<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
		<label for="quantity">Quantity:</label>
		<select name="quantity" id="quantity">
      <?php for ($i=1; $i<=10; $i++): //creating 10 option values?>
        <option value="<?= $i ?>"><?= $i ?></option>
      <?php endfor; ?>
    </select>
		<input type="submit" class="red" value="Add to Cart" name="add-to-cart">
	</div>
	</form>
		
	
	
	</body>
</html>