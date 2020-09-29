<?php
	
	if ( !$_SESSION['logged_user'] )
	{
		header("Location:index.php?action=login");
	}

	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM `Rozklad` WHERE `id` = '$id'";
	$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));

	if ( mysqli_num_rows($data) == 0 )
	{
		echo "<h2>This page has benn deleted or not created yet!</h2>";
	}
	else
	{
		echo "<form id='confirm_delete' method='POST'>
	
				<p>Are you sure, you want do dlete this article?</p>
				<input type='submit' name='yes' value='YES'>
				<input type='submit' name='no' value='NO'>

			</form>";

		if ( isset($_POST['yes']) )
		{
			$sql = "DELETE FROM `Rozklad` WHERE `id` = '$id'";
			mysqli_query($connection, $sql) or die (mysqli_error($connection));

			$filename = "/var/www/html/studkurator/cache/casherozkl.json";
			unlink($filename);

			unset($_SESSION['visited']);

			echo "<script type='text/javascript'>
  					location.replace('index.php?action=deleted-successfully');
				</script>";
		}
		elseif ( isset($_POST['no']) )
		{
			echo "<script type='text/javascript'>
  					location.replace('index.php?action=viewarticle&id=" . $id . "');
				</script>";
		}
	}

?>