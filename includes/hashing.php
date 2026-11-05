<?php 
function hashing($hword,$user)
{
	$s1 = 'sdfghjko';
	$s2='sejgfwrhgrwpgnwr';
	
	$user = $s1.$user.$s2;
	$userDouble = $s1.$user.$user.$s2;
	
	$salt1 = hash('sha512',$user);
	$salt2 = hash('sha512',$userDouble);
	
	$hword = $salt1.$hword.$salt2;
	$hword = hash('sha512',$hword);
	
	return $hword;
}
?>