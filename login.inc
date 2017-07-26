<?php
try
{
	//Use a prepared statement to search the users table for the requested username and password.
	$stmt = $pdo->prepare('SELECT * FROM users '.
	'WHERE username = :username AND password = SHA2(CONCAT(:password, salt), 0)');
	$stmt->bindValue(':username', $username);
	$stmt->bindValue(':password', $password);
	$stmt->execute();
}
catch (PDOException $e)
{
	echo $e->getMessage();
}
//Determine if the query returned any rows. If it did then the user will be redirected to the home page and they will be signed-in. Otherwise return an error.
$row = $stmt->rowCount();
if ($row > 0)
{
	session_start();
	$_SESSION['isAdmin'] = $username;
	header("Location: http://{$_SERVER['HTTP_HOST']}/CAB230/home_page.php");
	exit();
}
else
{
	$error = 'Username or Password is invalid!';
}
?>