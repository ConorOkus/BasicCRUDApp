<?php

	// This page let's users log in to the site
    
    // Set the page title and include the header file
	define('TITLE', 'Login');
	include 'templates/header.php';
	
	session_start();
	
	$dbc = mysqli_connect("", "", "", "");
	
	// If the form is submiited
	if (isset($_POST['username']) && isset($_POST['password'])) {
		
		// Assign posted values to variables
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Check values exist in the database
		$query = "SELECT * FROM `user` WHERE username='$username' and password='$password'";
		
		$result = mysqli_query($dbc, $query);
		$count = mysqli_num_rows($result);
		
		// If the posted values are equal to the database values, then session will be created for the user.
		if ($count == 1) {
			
			$_SESSION['username'] = $username;
			
		} else {
			
			print '<p>Invalid Login Creditials</p>';
		}
		
		// If the user is logged in
		if (isset($_SESSION['username'])) {
			
			$username = $_SESSION['username'];
			
			print '<p>Hello' . $username . '</p>';
			
			print '<hr /><h3>Site Admin</h3><p><a href="add_post.php">Add post</a>
					<a href="view_post.php">View Posts</a>
					<a href="logout.php">Logout</a></p>';
		}	
		
	}
	
	print '<h2>Login Form</h2>
		<form action="login2.php" method="post">
		<p><label>Username</label> <input type="text" name="username" /></p>
		<p><label>Password</label> <input type="password" name="password" /></p>
		<p><input type="submit" name="submit" value="Log In!" /></p>
		</form><br />';
		
	print '<a href="register.php">Register Here</a>';
	
    
?>