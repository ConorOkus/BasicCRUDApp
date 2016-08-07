<?php
    /* This script deletes a post */
    
    // Define the title and include the header
    define('TITLE', 'Delete a Post');
	include 'templates/header.php';
	
	print '<h2>Delete a Post</h2>';
	
	// Restrict access to administrators only:
if (!is_administrator()) {
	print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
	include('templates/footer.php');
	exit();
}
	
	// Database Connection
	$dbc = mysqli_connect("igor.gold.ac.uk", "ma301co", "conor", "ma301co_myblog");
	
	// Display the entry in a form
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		
		// Define the query 
		$query = "SELECT post_title, post_entry FROM blog_post WHERE post_id={$_GET['id']}";
		if ($r = mysqli_query($dbc, $query)) { // Run the query
			
			// Get the results of the query
			$row = mysqli_fetch_array($r);
		
			// Make the form 
			print '<form action="delete_post.php" method="post">
				   <p>Are you sure want delete this post?</p>
				   <p><h3>' . $row['post_title'] . '</h3>' . $row['post_entry'] . '<br />
				   <input type="hidden" name="id" value="' . $_GET['id'] . '" />
				   <input type="submit" name="submit" value="Delete this Post!" /></p>
				   </form>';
				   
		} else { // Couldn't get the information
			
			print '<p class="error">Could not retrieve the blog post because: <br />' . 
			mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
			
		}
		
	} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form
		
		// Define the query
		$query = "DELETE from blog_post WHERE post_id={$_POST['id']} LIMIT 1";
		$r = mysqli_query($dbc, $query);
		
		// Report on the result
		if (mysqli_affected_rows($dbc) == 1) {
			
			 print '<p>The blog post has been deleted</p>';
			
		} else { // If there is an error deleting the post
			
			print '<p class="error">Could not delete the blog entery because: <br />' . 
			mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
		
	} else { // No ID recieved
		
		print '<p class="error">This page has been accessed in error</p>';
	}
	
	mysqli_close($dbc);
	
	include 'templates/footer.php';
?>