<!-- Include functions script  -->
<?php include 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en
">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php if (defined('TITLE')) {
  	print TITLE;  
  } else {
  	print 'My Blog';
  } ?></title>

  <meta name="viewport" content="width=device-width; initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />

</head>

<body>
	<div id="container">
		<h1>My Blog</h1>
		<br />
		<!-- Begin Content -->
