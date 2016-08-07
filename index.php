<?php

// Home screen to display the post to unregistered users

// Add the header
include 'templates/header.php';

// Create a link to the login page
print '<a href="login.php">Login Here</a>
		<br />';

// Add form to search the site
print '<br /><form action="search_function.php" method="post">
		<input name="search" type="text" size="40" />
		<input type="submit" name="submit" value="Search" />
		</form>';

// Database connection
$dbc = mysqli_connect("", "", "", "");

// Define the query
$query = 'SELECT * FROM blog_post ORDER BY date_entered DESC';


// Run the query
if ($r = mysqli_query($dbc, $query)) {
	
	while ($row = mysqli_fetch_array($r)) { // While there are rows to be displayed, print them.
		print "<p><h3>{$row['post_title']}</h3><br />
		{$row['post_entry']}<br />
		<p>This post was created on {$row['date_entered']}</p>";
		
		if (is_administrator()) { // If the user is admin then display editorial links
		print "<br /><b>Site Admin:</b> <a href=\"edit_post.php?id={$row['post_id']}\">Edit</a> 
		<a href=\"delete_post.php?id={$row['post_id']}\">Delete</a>
		</p>\n";
	   } 
	   	print "<hr />";
	}

} else {// Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
}// End of query IF.

mysqli_close($dbc);

include 'templates/footer.php';
?>

