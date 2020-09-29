<?php
	
	if ( !$_SESSION['logged_user']  )
	{
		header("Location:index.php?action=login");
	}

?>
<a href="index.php?action=news" style="text-decoration: none;"><p id="back_button">Назад</p></a>
<?php

	if ( isset($_POST['add']) )
	{
		$file = basename($_FILES['userfile']['name']);
		$uploaddir = "/var/www/html/pizza/images/";
		$uploadfile = $uploaddir . $file;

		$title = mysqli_real_escape_string($connection, $_POST['title']);
		$text = mysqli_real_escape_string($connection, $_POST['text']);

		if ( strlen($title) == 0 || strlen($text) == 0)
		{ 
			die("<h2 style='color: red'>All fields should be filled!</h2>");
		}

		$errror = false;
		$uploaded = false;
        if ( $_FILES['userfile']['errror']  == UPLOAD_ERR_OK )
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
			$uploaded = true;
		}
		else
		{
			$errror = true;
		}
		if ( !$error && $uploaded )
		{
			$image = "images/" . $file;
			$id = $_SESSION['logged_user']['id'];

			if ( $_SESSION['logged_user']['admin'] == 1 )
			{
				$visible = 1;
			}
			else
			{
				$visible = 0;
			}
		

			$sql = "INSERT INTO `news` (`author_id`, `text`,`image`, `intro`) VALUES ('$id', '$text','$image', '$title', )";
			mysqli_query($connection, $sql) or die(mysqli_error($connection));

			$filename = "/var/www/html/studkurator/cache/cachenews.json";
			unlink($filename);
			unset($_SESSION['visited']);

			echo "<script type='text/javascript'>
					location.replace('index.php?action=recipes');
				</script>";
		}
	}

?>

<form id="add_recipe" enctype="multipart/form-data" accept="image" method="POST">

	<label><p class="add_text">Назва</p></label>
	<input type="text" name="title" required/>
	<label><p class="add_text">Текст</p></label>
	<textarea name="text" required></textarea>
	<label><p class="add_text">image</p></label>
	<input type="hidden" name="MAX_FILE_SIZE" value="30000000"/>
	<input type="file" name="userfile" required>
	<br>
	<br>
	<button type="submit" name="add">Додати</button>

</form>