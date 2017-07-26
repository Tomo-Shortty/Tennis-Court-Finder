<?php
	$pdo = new PDO('mysql:host=localhost;dbname=tennis_court_finder', 'root', 'Thefrogpod!7');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>