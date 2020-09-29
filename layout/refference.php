<?php

	if ( isset($_SESSION['logged_user']) )
	{
		require_once "layout/user_menu.php";
	}
	else
	{
		require_once "layout/setup_menu.php";
	}

?>