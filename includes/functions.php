<?php 
/* This page defines custom functions. */

// This function checks if the user is an administrator.
// This function returns a Boolean value.

function is_administrator() {
	
	session_start();
	// Check for the session
	if (isset($_SESSION['loggedin'])) {
		return true;
	} else {
		return false;
	}

} // End of is_administrator() function.

// Reference: PHP for the Web by Larry Ullman p.384 Script 13.2 // 

?>