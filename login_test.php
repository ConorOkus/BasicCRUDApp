<?php
// This page let's users log in to the site

// Set the page title and include the header file
define('TITLE', 'Login');
include 'templates/header.php';

// Starting Session
session_start();

// Variable To Store Error Message
$error = '';

if (isset($_POST['submit'])) {
	
	if (empty($_POST['username']) || empty($_POST['password'])) {
		
		$error = "Username or Password is invalid";
		
	} else {
		
		// Define $username and $password
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$dbc = mysqli_connect("igor.gold.ac.uk", "ma301co", "conor", "ma301co_myblog");
		
		// SQL query to fetch information of registerd users and finds user match.
		$query = "SELECT * FROM user WHERE username='$username' and password='$password'";
		$result = mysqli_query($dbc, $query);
		$rows = mysqli_num_rows($result);
		if ($rows == 1) {
			$_SESSION['login_user'] = $username;
			// Initializing Session
			header("location: add_post.php");
			// Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}
		mysqli_close($dbc);
		// Closing Connection
	}
}
	
	print '<h2>Login Form</h2>
	<form action="login_test.php" method="post">
	<p><label>Username <input type="text" name="username" /></label></p>
	<p><label>Password <input type="password" name="password" /></label></p>
	<p><input type="submit" name="submit" value="Log In!" /></p>
	</form>';
	
	
?>