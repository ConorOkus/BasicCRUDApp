<!-- This script connects to a MySQL server.  -->

<?php

$dbc = mysqli_connect("igor.gold.ac.uk", "ma301co", "conor", "ma301co_myblog");

if (!mysqli_connect_errno()) {
	print '<p>Successfully connected to MySQL</p>';
} else {
	print '<p class="error">' . "Failed to connect to MySQL: " . mysqli_connect_error() . '</p>';
}

mysqli_close($dbc);

?>

