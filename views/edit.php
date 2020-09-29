<?php
	
	if ( !$_SESSION['logged_user'] )
	{
		header("Location:index.php?action=login");
	}


	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM `news` WHERE `id` = '$id'";
	$data = mysqli_query($connection, $sql) or die (mysqli_error($connection));

	if ( mysqli_num_rows($data) == 0)
	{
		echo "<h2 style='color: red'>This page has been deleted or not created yet!</h2>";
	}
	else
	{
		$result = mysqli_fetch_assoc($data);

	?>
	<a href='index.php?action=viewarticle&id=<?= $id ?>' style='text-decoration: none;'><p id='back_button'>Відмінити</p></a>
			<form id='add_recipe' enctype='multipart/form-data' accept='image' method='POST'>

				<label><p class='add_text'>Назва</p></label>
				<input type='text' name='title' value='<?= $result['intro'] ?>' required/>
				<label><p class='add_text'>Текст</p></label>
				<textarea name='text' required><?= $result['text'] ?></textarea>
				<label><p class='add_text'>image</p></label>
				<input type='hidden' name='MAX_FILE_SIZE' value='30000000'/>
				<input type='file' name='userfile'><br>
				<br>
				<br>
				<button type='submit' name='submit'>Зберегти зміни</button>

			</form>
	<?php

		if ( isset($_POST['submit']) )
		{
			$intro = mysqli_real_escape_string($connection, $_POST['title']);
			$text = mysqli_real_escape_string($connection, $_POST['text']);
			$published = $_POST['published'];
			$error = false;

			if ( !empty($_FILES['userfile']['name']) )
			{
				$file = basename($_FILES['userfile']['name']);
				$uploaddir = "/var/www/html/pizza-funpage.ua/images/";
				$uploadfile = $uploaddir . $file;

				$uploaded = false;

				if ( $_FILES['userfile']['errror']  == UPLOAD_ERR_OK )
				{
					move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
					$uploaded = true;
					$image = "images/" . $file;
					$image_param = "`image` = '$image',";
				}
				else
				{
					$errror = true;
				}
			}
			else
			{
				$uploaded = true;
				$image_param = "";
			}
			if ( !$error && $uploaded )
			{
				$sql = "UPDATE `news` SET `intro` = '$intro', `text` = '$text', $image_param `published` = '$published' WHERE `id` = '$id'";
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