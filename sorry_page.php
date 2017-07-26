<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	session_start();
	
	include 'login_button.inc';
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<title>Sorry</title>
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
			<h1>Sorry!</h1>
			<p>You must be logged in to post reviews. Click on the Log In button in the menu above to sign in. If you don't have an account you can create one by clicking on the Log In button and following the instructions on the right portion of the page.</p>
		</div>
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>