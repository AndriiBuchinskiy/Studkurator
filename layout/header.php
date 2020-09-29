<?php

	$login = $_SESSION['logged_user']['login'];
	$id = $_SESSION['logged_user']['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Responsive page</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
		<meta charset="utf-8">
	</head>
	<body>
		<div id = "prop">
		
	    </div>
	   
		<header id="header">
			<div align="left"><h1>StudKurator</h1></div>

		</header><!--
		--><div class="body-new">
		   <!--<div class="nav_image">
		   	<img src="images/FC.jpg"></p>
		   </div>
		-->
		<?php
				require_once "layout/refference.php";
		?>