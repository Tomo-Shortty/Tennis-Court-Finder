<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	//Set error variables.
	$error = '';
	$errorMessage = '';
	
	//Determine if the Login or the Register button has been pressed.
	if (isset($_POST['Login']))
	{
		//Set the username and password values to a variable.
		$username = $_POST['username'];
		$password = $_POST['userpw'];
		
		//Check if the username and password fields are empty. Return an error if they are, otherwise search the users table for the inputted username and password.
		if (empty($username) || empty($password))
		{
			$error = 'Username or Password is invalid!';
		}
		else
		{
			include 'login.inc';
		}
	}
	elseif (isset($_POST['Register']))
	{
		//Set the username, password, email and age values to a variable.
		$newUser = $_POST['usernamer'];
		$newPassword = $_POST['userpwr'];
		$email = $_POST['email'];
		$age = $_POST['age'];
		
		//Place the data into the users table.
		include 'registration.inc';
	}
	include 'login_button.inc';
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<title>Sign-in</title>
	</head>
	<body>
		<!--Create the header.-->
		<div id="Header">
			<h1>Tennis Court Finder</h1>
		</div>
		<!--Create the wrapper that will help centre the page.-->
		<div id="Wrapper">
			<!--Create the menu.-->
			<div id="Menu">
				<?php
					include 'menu.inc';
				?>
			</div>
			<!--Create the register form. This form will create a new account for a user.-->
			<div id="Register">
				<fieldset>
				<h2>Don't have an account? Register here!</h2>
				<!--Calls Javascript function passwordMatch(form) to validate the values in the fields.-->
				<form action="registration_page.php" method="POST" name="registerName" onsubmit="return passwordMatch(this);">
					<!--Create the username field.-->
					<p>Choose a username:</p>
					<input type="text" name="usernamer" value="<?php
					//Check there is something in the form.
					if(isset($_POST['usernamer']))
						echo htmlspecialchars($_POST['usernamer'])?>"/ required>
					<!--Create the email field.-->
					<p>Email:</p>
					<input type="email" name="email" value="<?php
					//Check there is something in the form.
					if(isset($_POST['email']))
						echo htmlspecialchars($_POST['email'])?>"/ required>
					<!--Create the age field.-->
					<p>How old are you?</p>
					<select name="age">
						<option>Younger than 16</option>
						<option>16 - 20</option>
						<option>21 - 25</option>
						<option>26 - 30</option>
						<option>31 - 35</option>
						<option>36 - 40</option>
						<option>46 - 50</option>
						<option>51 - 55</option>
						<option>56 - 60</option>
						<option>61 - 65</option>
						<option>66 - 70</option>
						<option>Older than 70</option>
					</select>
					<!--Create the password field.-->
					<p>Choose a password:</p>
					<input type="password" name="userpwr" value="<?php
					//Check there is something in the form.
					if(isset($_POST['userpwr']))
						echo htmlspecialchars($_POST['userpwr'])?>"/required>
					<!--Create the confirm password field.-->
					<p>Re-enter password:</p>
					<input type="password" name="checkpwr" value="<?php
					//Check there is something in the form.
					if(isset($_POST['checkpwr']))
						echo htmlspecialchars($_POST['checkpwr'])?>"/required>
					<p></p>
					<!--Create the submit button. Will execute the register form when clicked.-->
					<input type="submit" name="Register" value="Create Account">
					<br>
					<br>
					<!--Display error messages relating to the form.-->
					<span><?php echo $errorMessage; ?></span>
				</form>
				</fieldset>	
			</div>
			<!--Create the sign-in form. This form will start a session for a registered user, allowing them to post reviews.-->
			<div id="Sign-in">
				<fieldset>
				<h2>Please sign-in:</h2>
				<form action="registration_page.php" method="POST" name="signIn">
					<!--Create the username field.-->
					<p> Enter username: </p>
					<input type="text" name="username">
					<!--Create the password field.-->
					<p> Enter password: </p>
					<input type="password" name="userpw">
					<p></p>
					<!--Create the submit button. Will execute the sign-in form when clicked.-->
					<input type="submit" name="Login" value="Login">
					<br>
					<br>
					<!--Display any errors relating to the form.-->
					<span><?php echo $error; ?></span>
				</form>
				<br>
				<br>
				<br>
				</fieldset>
			</div>
		</div>
		<!--Create the footer.-->
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>