<!DOCTYPE html>
<?php
	include 'selectDB.inc';
	
	session_start();
	if (!isset($_SESSION['isAdmin']))
	{
		header("Location: http://{$_SERVER['HTTP_HOST']}/CAB230/sorry_page.php");
		exit();
	}
	
	include 'login_button.inc';
?>
<html>
	<head>
		<?php
			include 'head.inc';
		?>
		<title>Review</title>
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
		<div id="Left">
			<h1>Review a Court</h1>
			<div id="ReviewQuestions">
				<?php
					if (isset($_POST['SubmitReview']))
					{
						$user = $_SESSION['isAdmin'];
						$court = $_POST['court'];
						$star = $_POST['stars'];
						$commentBox = $_POST['CommentBox'];
						try
						{
							$stmt = $pdo->prepare("INSERT INTO reviews (User, Venue, Date, Comments, Rating) ".
							"VALUES ('$user', '$court', CURDATE(), '$commentBox', '$star')");
							$stmt->execute();
						}
						catch (PDOException $e)
						{
							echo $e->getMessage();
						}
					}
				?>
				<form action="review_page.php" method="POST" name="review">
					<p>Select the court you would like to review:</p>
					<?php
						try
						{
							$result = $pdo->query('SELECT items.Venue '.
							'FROM items ');
						}
						catch (PDOException $e)
						{
							echo $e->getMessage();
						}
					?>
					<select name="court">
					<?php
						foreach ($result as $item)
						{
							echo '<option value="',$item['Venue'],'">',$item['Venue'],'</option>';
						}
					?>
					</select>
					<br>
					<br>
					<p>Please select the star rating:</p>
					<input type="radio" name="stars" value="0"> 0 stars
					<input type="radio" name="stars" value="1"> 1 star
					<input type="radio" name="stars" value="2"> 2 stars
					<input type="radio" name="stars" value="3"> 3 stars
					<input type="radio" name="stars" value="4"> 4 stars
					<input type="radio" name="stars" value="5"> 5 stars
					<br>
					<br>
					<p>Comments:</p>
					<p><span>*must be no more than 500 characters</span></p>
					<textarea name="CommentBox" id="CommentBox" maxlength="500"></textarea>
					<br>
					<br>
					<input type="submit" name="SubmitReview" value="Submit Review">
				</form>
			</div>
		</div>
		<div id="Right">
			<h1>Reviews</h1>
			<div id="ReviewTable">
				<table>
				<?php
					try
					{
						$result = $pdo->query('SELECT reviews.User, reviews.Venue, reviews.Date, reviews.Comments, reviews.Rating '.
						'FROM reviews '.
						'ORDER BY Date DESC ');
					}
					catch (PDOException $e)
					{
						echo $e->getMessage();
					}
					foreach ($result as $review)
					{
						echo '<tr>
							<th>Posted by: ', $review['User'],'</th>
							<th>Date: ', $review['Date'],'</th>
						</tr>';
						echo '<tr>
							<td>Venue: ', $review['Venue'],'</td>
							<td>Rating: ', $review['Rating'],'/5</td>
						</tr>';
						echo '<tr>
							<td colspan="2">', $review['Comments'],'</td>
						</tr>';
					}
				?>
				</table>
			</div>
		</div>
		<div id="Footer">
			<?php
				include 'footer.inc';
			?>
		</div>
	</body>
</html>