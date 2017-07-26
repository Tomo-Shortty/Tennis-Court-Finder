<?php
//Generate random 10 characters for salt
$chars = '0123456789abcdefghijklmnopABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charsLength = strlen($chars);
$randomSalt = "";
for($i = 0; $i < 13; $i++)
{
	$randomSalt .= $chars[rand(0, $charsLength - 1)];
}
	
try
{
	//Use a prepared statement to insert the data into the users table.
	$stmt = $pdo->prepare("INSERT INTO users (username, salt, password, email, age) ".
	"VALUES ('$newUser', '$randomSalt', SHA2(CONCAT('$newPassword', '$randomSalt'), 0), '$email', '$age')");
	$stmt->execute();
}
catch(PDOException $e)
{
	//Display an error if the data could not be added.
	$errorMessage = 'Error creating account. The username you are trying to use may have been taken. Please try again.';
}
//Determine if the query created a row. If true then the user has successfully created an account and is now logged on. Otherwise return an error.
$row = $stmt->rowCount();
if ($row > 0)
{
	session_start();
	$_SESSION['isAdmin'] = $newUser;
	header("Location: http://{$_SERVER['HTTP_HOST']}/CAB230/home_page.php");
	exit();
}
else
{
	$errorMessage = 'Error creating account. The username you are trying to use may have been taken. Please try again.';
}
?>