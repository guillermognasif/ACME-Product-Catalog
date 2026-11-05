<?php 
function isGranted()
{
	if( isset($_SESSION['granted'])) return true;
	return false;
}
?>