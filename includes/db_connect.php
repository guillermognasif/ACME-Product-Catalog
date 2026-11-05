<?php
if ($_SERVER['HTTP_HOST']=='localhost')
{
	define('HOST','localhost');
	define('USER','root');
	define('PASS','1550');
	define('DB','users'); 
}

else 
{
	define('HOST','sql100.infinityfree.com');
	define('USER','if0_39037947');
	define('PASS','csis1550');
	define('DB','if0_39037947_users');
}
			
$conn = mysqli_connect(HOST,USER,PASS,DB);

return $conn;

?>
