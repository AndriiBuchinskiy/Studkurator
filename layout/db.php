<?php

	$connection = mysqli_connect("localhost", "root", "", "Stud");
	if ( !$connection )
	{
		die("Connection failed: " . mysqli_connect_error());
	}

?>