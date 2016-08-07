<?php
   
   // Define page and include footer
   define('TITLE', 'Logout');
   include 'templates/header.php';
   
   // Start session in order to access session variables
   session_start();
   
   // Erase all key value pairs in $_SESSION
   $_SESSION = array();
   
   // Destroy session data on server
   session_destroy();
   
   // Print message
   print '<p>You are now logged out</p>';
   
   print '<p><a href="login.php">Log In</a></p>';
   
?>