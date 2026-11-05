<?php 
function table_printing()
{
$tStart = '<table><tr><th>Product Name</th><th>Price per Unit</th><th>Quantity</th><th>Total</th></tr>';
$tContent = '';
$tEnd = '</table>';
$totalPrice = 0;
if (!isset($_SESSION['product-id']))
			{
				echo '<h1>Empty Cart</h1>';
			}
			else 
			{
				?>
				<form method="POST">
				<?php
				for($x = 0; $x < sizeof($_SESSION['product-id']); $x++)
				{
					$tContent .= '<tr>';
					$tContent .= '<td>'.$_SESSION['pName'][$x].'</td>';
					$tContent .= '<td>'."$".''.$_SESSION['price'][$x].'</td>';
					$tContent .= '<td><input type="text" name="qty-'.$x.'" value="'.$_SESSION['quantity'][$x].'"></td>';
					$tContent .= '<td>'."$".''.($_SESSION['price'][$x] * $_SESSION['quantity'][$x]).'</td>';
					$tContent .= '</tr>';
					$totalPrice += $_SESSION['price'][$x] * $_SESSION['quantity'][$x];
				}
				$tContent.= '<tr><td colspan="3"> Total to Pay:</td><td>'."$".''.$totalPrice.'</td></tr>';
				$table = $tStart.$tContent.$tEnd;
				echo $table;
				?>
				<input type="submit" name="update" class="red" value="Update Cart">
				<input type="submit" name="place" class="red" value="Place Order">
				</form>
				<?php
			}
}
function costumer_receipt() 
{
$tStart = '<table><tr><th>Product Name</th><th>Price per Unit</th><th>Quantity</th><th>Total</th></tr>';
$tContent = '';
$tEnd = '</table>';
$totalPrice = 0;
if (!isset($_SESSION['product-id']))
			{
				echo '<h1>Empty Cart</h1>';
			}
			else 
			{
				?>
				<form method="POST">
				<?php
				for($x = 0; $x < sizeof($_SESSION['product-id']); $x++)
				{
					$tContent .= '<tr>';
					$tContent .= '<td>'.$_SESSION['pName'][$x].'</td>';
					$tContent .= '<td>'."$".''.$_SESSION['price'][$x].'</td>';
					$tContent .= '<td>'.$_SESSION['quantity'][$x].'</td>';
					$tContent .= '<td>'."$".''.($_SESSION['price'][$x] * $_SESSION['quantity'][$x]).'</td>';
					$tContent .= '</tr>';
					$totalPrice += $_SESSION['price'][$x] * $_SESSION['quantity'][$x];
				}
				$tContent.= '<tr><td colspan="3"> Total Paid</td><td>'."$".''.$totalPrice.'</td></tr>';
				$table = $tStart.$tContent.$tEnd;
				echo $table;
				?>
				</form>
				<?php
			}
}
?>