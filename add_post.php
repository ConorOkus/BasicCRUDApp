<?php 
/* This script adds a post. */

// Define a page title and include the header:
define('TITLE', 'Add a Post');
include ('templates/header.php');

print '<h2>Add a Post</h2>';

// Restrict access to administrators only:
if (!is_administrator()) {
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.php');
	exit();
}

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	
	// Database connection
	$dbc = mysqli_connect("", "", "", "");
	
	// If the post is not empty add the post
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		
		// Store user entry into variables
		$title = mysqli_real_escape_string($dbc, $_POST['title']);
    	$entry = mysqli_real_escape_string($dbc, $_POST['entry']); 
		
		// Define the query
		$query = "INSERT INTO blog_post (post_id, post_title, post_entry, date_entered) VALUES (0, '$title', '$entry', NOW())";
		
		// Check if query has been submitted successfully
		if (mysqli_query($dbc, $query)) {
			print '<p>Your post has been added</p>';
		} else {
			print '<p class="error">Could not store the post because:<br />' . mysqli_error($dbc);
		}
		
		mysqli_close($dbc);
		
	} else { // If the form is empty
		print '<p class="error">Please enter a title and post</p>';
	}

} // End of submitted IF.

// Leave PHP and display the form:
?>
	<!-- Display the form -->
 	<form action="add_post.php" method="post">
	<p>Post Title: <input type="text" name="title" /></p>
	<p>Post Entry: <textarea name="entry" cols="40" rows="5"></textarea><br />
	<input type="hidden" name="author" value="' . $_SESSION['username'] . '" />	
	<br />	
    <input type="submit" name="submit" value="Post This Entry" />
	</form>
	
	<!-- Include the footer  -->
	<?php include 'templates/footer.php'; ?>



