<?php

	if ( isset($_POST['add']) )
	{
		$Day = mysqli_real_escape_string($connection, $_POST['Day']);
		$first = mysqli_real_escape_string($connection, $_POST['first']);
		$second = mysqli_real_escape_string($connection, $_POST['second']);
		$thirth = mysqli_real_escape_string($connection, $_POST['thirth']);
		$fourth = mysqli_real_escape_string($connection, $_POST['fourth']);

		

			$sql = "INSERT INTO `Rozklad` (`Day`, `first`, `second`, `thirth`, `fourth`) VALUES ('$Day', '$first', '$second', '$thirth', '$fourth')";
			mysqli_query($connection, $sql) or die(mysqli_error($connection));

			$filename = "/var/www/html/studkurator/cache/cachenews.json";
			unlink($filename);
			unset($_SESSION['visited']);

			echo "<script type='text/javascript'>
					location.replace('index.php?action=recipes');
				</script>";
		}
	

?>

<form id="add_recipe" enctype="multipart/form-data" accept="image" method="POST">

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
	<button type="submit" name="add">Додати</button>

</form>
<?php
	
	if ( !$_SESSION['logged_user']  )
	{
		header("Location:index.php?action=login");
	}

?>
<a href="index.php?action=recipes" style="text-decoration: none;"><p id="back_button">Назад</p></a>