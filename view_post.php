<?php
// This script allows an admin to view all of the posts on the site

// Define title and include the header
define('TITLE', 'View All Posts');
include 'templates/header.php';

print '<h2>All Posts</h2>';

// Restrict access to administrators only:
if (!is_administrator()) {
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.php');
	exit();
}
	// Create database connection
	$dbc = mysqli_connect("igor.gold.ac.uk", "ma301co", "conor", "ma301co_myblog");

	// Define the query
	$query = 'SELECT * FROM blog_post ORDER BY date_entered DESC';
	

	// Run the query
	if ($r = mysqli_query($dbc, $query)) {
		// Loop goes through first query and diplays the content and the entry 
		// Add links to edit and delete the post
		while ($row = mysqli_fetch_array($r)) {
			print "<p><h3>{$row['post_title']}</h3>
			<br />
		{$row['post_entry']}<br />
		<br />
		<a href=\"edit_post.php?id={$row['post_id']}\">Edit</a> 
		<a href=\"delete_post.php?id={$row['post_id']}\">Delete</a>
		</p><hr />\n";
		}

	} else {// Query didn't run.
		print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
	}// End of query IF.

	mysqli_close($dbc);

	include 'templates/footer.php';

?>