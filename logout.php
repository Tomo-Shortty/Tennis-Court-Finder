<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	session_start();
	unset($_SESSION['isAdmin']);
	
	include 'login_button.inc';
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<title>All Courts</title>
	</head>
	<body>
		<div id="Header">
			<h1>Tennis Court Finder</h1>
		</div>
		<div id="Menu">
			<?php
				include 'menu.inc';
			?>
		</div>
		<div id="TableContent">
			<h1>You are now logged out!</h1>
			<p></p>
			<p></p>
			<p></p>
			<p></p>
			<p></p>
		</div>
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>