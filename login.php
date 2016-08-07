<?php
	// This page let's users log in to the site
	
	// Set the page title and include the header file
	define('TITLE', 'Login');
	include 'templates/header.php';

	print '<h2>Log In</h2>';
	
	// Check for form submission
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
	// Database connection
	$dbc = mysqli_connect("", "", "", "");
	
	// Check if the form has been filled in
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		
		// Store user input into the following variables 
		$username = mysqli_real_escape_string($dbc, $_POST['username']);
		$password = mysqli_real_escape_string($dbc, md5($_POST['password']));
		
		// Define a query and store the result
		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($result);
		
		// If the creditials match create a session and log the user in
		if (htmlentities($row['username']) == $username && htmlentities($row['password']) == $password) {
			session_start();
			$_SESSION['username'] = $username; // Store username in session variable
			$_SESSION['loggedin'] = time();; // Store how long the user has been logged in
			print '<p>Hi ' . $username . ' you are now logged in</p>';
		} else {
			// Details do not match with those in database
			print '<p class="error">Sorry your details do not match those on file please register first.</p>';
			
			print '<form action="login.php" method="post">
					<p><label>Username <input type="text" name="username" /></label></p>
					<p><label>Password <input type="password" name="password" /></label></p>
					<p><input type="submit" name="submit" value="Log In!" /></p>
					</form>';
	
			print '<p><a href="register.php">Register Here</a></p>';
		}
		
		
		} else {
			// If user attempts to submit a blank form
			print '<p class="error">Please fill in your log in details</p>';
			
			print '<form action="login.php" method="post">
					<p><label>Username <input type="text" name="username" /></label></p>
					<p><label>Password <input type="password" name="password" /></label></p>
					<p><input type="submit" name="submit" value="Log In!" /></p>
					</form>';
	
			print '<p><a href="register.php">Register Here</a></p>';
	
		}
		
	} else {
	
			print '<form action="login.php" method="post">
			<p><label>Username <input type="text" name="username" /></label></p>
			<p><label>Password <input type="password" name="password" /></label></p>
			<p><input type="submit" name="submit" value="Log In!" /></p>
			</form>';
	
			print '<p><a href="register.php">Register Here</a></p>';
	}
			include 'templates/footer.php';


?>

	
	
