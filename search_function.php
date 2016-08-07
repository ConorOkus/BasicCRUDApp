<?php

	// Add page title and header
    define('TITLE', 'Search');
	include 'templates/header.php';
	
	print '<h2>Search Results</h2>';
	
	// Check if the form has been filled in
	if (!empty($_POST['search'])) {
	
	// Establish a database connection
	$dbc = mysqli_connect("igor.gold.ac.uk", "ma301co", "conor", "ma301co_myblog");
	
	// The field is not set keep the user on the index page
	if (!isset($_POST['search'])) {
		header('Location:index.php');
	}
	
	// Query that selects post title and post entry
	$query = "SELECT * FROM blog_post WHERE post_title LIKE '%".$_POST['search']."%' 
	OR post_entry LIKE '%".$_POST['search']."%'";
	$result = mysqli_query($dbc, $query);
	
	// If there are rows store them in array
	if (mysqli_num_rows($result) != 0) {
		$row = mysqli_fetch_array($result);
	} 
	
	print '<p>Here are the results!</p>';
	
	// If there are rows print the post title while there are rows or print there are no results
	if (mysqli_num_rows($result) != 0) {
		do {
			
			print $row['post_title'] . "<br />";
			
		} while ($row = mysqli_fetch_array($result));
		
	} else {
		
		print '<p>No results found!</p>';
	}
	
	} else {
		
		header('Location:index.php');
	}	
	
	include 'templates/footer.php';
?>