<?php

	if ( isset($_POST['add']) )
	{
		//$№ = mysqli_real_escape_string($connection, $_POST['№']);
		$props = mysqli_real_escape_string($connection, $_POST['props']);
		$dates = mysqli_real_escape_string($connection, $_POST['dates']);
		$respon = mysqli_real_escape_string($connection, $_POST['respon']);
		$note = mysqli_real_escape_string($connection, $_POST['note']);

		

			$sql = "INSERT INTO `Plans` ( `props`, `dates`, `respon`, `note`) VALUES ('$props', '$dates', '$respon', '$note')";
			mysqli_query($connection, $sql) or die(mysqli_error($connection));

			//$filename = "/var/www/html/studkurator/cache/cachenews.json";
			//unlink($filename);
			unset($_SESSION['visited']);

			echo "<script type='text/javascript'>
					location.replace('index.php?action=recipes');
				</script>";
		}
	

?>

<form id="add_recipe" enctype="multipart/form-data" accept="image" method="POST">

	
	<label><p class="add_text">Захід</p></label>
	<input type="text" name="props" required/>
	<label><p class="add_text">Дата виконання</p></label>
	<input type="date" name="dates" required/>
	<label><p class="add_text">Відповідальний</p></label>
	<input type="text" name="respon" required/>
	<label><p class="add_text">Примітка</p></label>
	<input type="text" name="note" required/>
	
	<br>
	<br>
	<button type="submit" name="add">Додати</button>

</form>
<?php
	
	if ( !$_SESSION['logged_user']  )
	{
		header("Location:index.php?action=login");
	}

?>
<a href="index.php?action=recipes" style="text-decoration: none;"><p id="back_button">Назад</p></a>