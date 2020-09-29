<?php

	session_start();

	require_once "layout/db.php";
	require_once "layout/header.php";

	if ( isset($_GET['action']) )
	{
		$action = $_GET['action'];
		if ( file_exists("views/$action.php") )
		{
			require_once "views/$action.php";
		} 
		else 
		{
			require_once "views/main.php";
		}
	}
	else
	{
		require_once "views/main.php";
	}

	require_once "layout/footer.php";

?>
