<?php

// This script allows a user to register for the site

// Give a page title and define the header 
define('TITLE', 'Register');
include 'templates/header.php';

print '<h2>Register</h2>';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Database connection
	$dbc = mysqli_connect("igor.gold.ac.uk", "ma301co", "conor", "ma301co_myblog");
	
	// Form validation
	if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
		
		// Store user input in variables with the password hashed
		$username = mysqli_real_escape_string($dbc, $_POST['username']);
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
		$password = md5($_POST['password']);
		
		// Define a query
		$query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
		
		// If the query is successfull let the user know they have been registered
		if (mysqli_query($dbc, $query)) {
			print '<p>Thank you for registering</p>';
		} else {
			print '<p class="error">Could not register user because:<br />' . mysqli_error($dbc);
		}

		mysqli_close($dbc);

	} else {
		print '<p class="error">Please fill in the form.</p>';
	}

}
	// Show the form
	print '<form action="register.php" method="post">
	<p>Username: <input type="text" name="username" /></p>
	<p>Email: <input type="email" name="email"/><br />
	<p>Password: <input type="password" name="password"/><br />
	<br />	
    <input type="submit" name="submit" value="Register" />
	</form>';
	
	print '<p><a href="login.php">Log In</a></p>';
	
	include 'templates/footer.php';


?>


