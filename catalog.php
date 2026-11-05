<?php
session_start();
include_once('includes/db_connect.php');
$sql = 'select * from product;';
$results = mysqli_query($conn,$sql);
$tStart = '<table><tr><th>Image</th><th>Product Name</th><th>Price</th><th>Link</th></tr>';
$tContent = '';
$tEnd = '</table>';
while($rows = mysqli_fetch_array($results,MYSQLI_ASSOC))
{
	$id = $rows['id'];
	$filePath = $rows['image'];
	$productName = $rows['name'];
	$productPrice = $rows['price'];
	
	$tContent.='<tr><td><img src ="'.$filePath.'"></td>';
	$tContent.='<td>'.$productName.'</td>';
	$tContent.='<td>'."$".''.$productPrice.'</td>';
	$tContent.='<td><a href = "product.php?id='.$id.'">View Product</a></td>';
	$tContent.='</tr>';
}

$table = $tStart.$tContent.$tEnd;


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Catalog</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Galindo&display=swap" rel="stylesheet">
	</head>
	<body>
	<?php 
	
	include('includes/functions.php');
	include_once('includes/nav.php');
	
	echo $table; 	
	?>
	
	</body>
</html>