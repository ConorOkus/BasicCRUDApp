<?php

// Define page title and include the header
define('TITLE', 'Edit a Post');
include 'templates/header.php';

print '<h2>Edit a Post</h2>';

// Restrict access to administrators only:
if (!is_administrator()) {
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.php');
	exit();
}

$dbc = mysqli_connect("", "", "", "");

// Display the entry in a form
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

	// Define the query
	$query = "SELECT post_title, post_entry FROM blog_post WHERE post_id={$_GET['id']}";
	if ($r = mysqli_query($dbc, $query)) {

		// Retrieve the information
		$row = mysqli_fetch_array($r);

		// Make the form:
		print '<form action="edit_post.php" method="post">
	<p>Entry Title: <input type="text" name="title" size="40" maxsize="100" value="' . htmlentities($row['post_title']) . '" /></p>
	<p>Entry Text: <textarea name="entry" cols="40" rows="5">' . htmlentities($row['post_entry']) . '</textarea></p>
	<input type="hidden" name="id" value="' . $_GET['id'] . '" />
	<input type="submit" name="submit" value="Update this Post!" />
	</form>';

	} else {// Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {// Handle the form.
	
	// Check if there is a problem
	$problem = FALSE;
	// Validate and secure the form data:
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		$title = mysqli_real_escape_string($dbc, $_POST['title']);
    	$entry = mysqli_real_escape_string($dbc, $_POST['entry']);
	} else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}

	if (!$problem) {

		// Define the query.
		$query = "UPDATE blog_post SET post_title='$title', post_entry='$entry' WHERE post_id={$_POST['id']}";
		
		// Execute the query.
		$r = mysqli_query($dbc, $query);
		

		// Report on the result by checking only 1 row has changeds
		if (mysqli_affected_rows($dbc) == 1) {
			print '<p>The blog entry has been updated.</p>';
		} else {
			print '<p style="color: red;">Could not update the entry because:<br />' . mysql_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
		}

	} // No problem!

} else {// No ID set.
	print '<p style="color: red;">This page has been accessed in error.</p>';
}
// End of main IF.

mysql_close($dbc);
// Close the connection.

include 'templates/footer.php';
?>