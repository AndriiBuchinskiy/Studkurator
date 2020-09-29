<?php
	
	if ( !$_SESSION['logged_user'] )
	{
		header("Location:index.php?action=login");
	}


	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM `Rozklad` WHERE `id` = '$id'";
	$data = mysqli_query($connection, $sql) or die (mysqli_error($connection));

	if ( mysqli_num_rows($data) == 0)
	{
		echo "<h2 style='color: red'>не працює</h2>";
	}
	else
	{
		$result = mysqli_fetch_assoc($data);

	?>
	<a href='index.php?action=viewarticle&id=<?= $id ?>' style='text-decoration: none;'><p id='back_button'>Відмінити</p></a>
			<form id='add_recipe' enctype='multipart/form-data' accept='image' method='POST'>

			<label><p class="add_text">День</p></label>
	        <input type="text" name="Day" required/>
	        <label><p class="add_text">Перша пара</p></label>
	        <input type="text" name="first" required/>
	        <label><p class="add_text">Друга пара</p></label>
	        <input type="text" name="second" required/>
	        <label><p class="add_text">Третя пара</p></label>
	        <input type="text" name="thirth" required/>
	        <label><p class="add_text">Четверта пара</p></label>
	        <input type="text" name="fourth" required/>
				<br>
				<br>
				<button type='submit' name='submit'>Зберегти зміни</button>

			</form>
	<?php

		if ( isset($_POST['submit']) )
		{
			$day = mysqli_real_escape_string($connection, $_POST['Day']);
			$first = mysqli_real_escape_string($connection, $_POST['first']);
			$second = mysqli_real_escape_string($connection, $_POST['second']);
			$thirth = mysqli_real_escape_string($connection, $_POST['thirth']);
			$fourth = mysqli_real_escape_string($connection, $_POST['fourth']);
			$error = false;

			

			if ( !$error )
			{
				$sql = "UPDATE `Rozklad` SET `Day`='$day', `first` = '$first', `second` = '$second', 
				`thirth` = '$thirth', `fourth` = '$fourth' WHERE `id` = '$id'";
				mysqli_query($connection, $sql) or die(mysqli_error($connection));

				$filename = "/var/www/html/studkurator/cache/cacherecipes.json";
				unlink($filename);
				unset($_SESSION['visited']);

				echo "<script type='text/javascript'>
						location.replace('index.php?action=recipes');
					</script>";
			}
		}
	}

?>