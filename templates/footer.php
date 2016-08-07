<!-- End Content -->

<?php 
	
	//  If the user is an admin and the page is not the logout page display the admin links.
	if (is_administrator() && basename($_SERVER['PHP_SELF']) != 'logout.php') {
			
	// Create the links:
	print '<hr /><h3>Site Admin</h3><p><a href="add_post.php">Add Post</a> <-> 
	<a href="view_post.php">View All Posts</a> <-> 
	<a href="logout.php">Logout</a>  <-> 
	<a href="index.php">Home</a>
	</p>';
	
		}

?>

 </div> <!-- Container -->
    <footer>
     <p class="copyright">&copy; Copyright  by Conor Okus</p>
    </footer>
  </div>
</body>
</html>
