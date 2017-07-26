<?php
//Determines if a user is logged on. If true then the log in button in the menu will change its text and link.
if (isset($_SESSION['isAdmin']))
{
	$page = 'logout.php';
	$log = 'Log Out';
}
else
{
	$page = 'registration_page.php';
	$log = 'Log In';
}
?>