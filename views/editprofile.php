<?php


            $marry = $_POST['marry'];
			$publ_miss = $_POST['publ_miss'];
			$res_adr_st = $_POST['res_adr_st'];
			$res_adr_ph = $_POST['res_adr_ph'];
			$parents = $_POST['parents'];


	$id = (int)$_GET['id'];

	if ( $_SESSION['logged_user']['id'] == $id )
	{
		$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
		$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		$result = mysqli_fetch_assoc($data);
	}
	else
	{
		echo "<script type='text/javascript'>location.replace('index.php');</script>";
	}


	if ( isset($_POST['submit_edit']) )
	{
		$login    = mysqli_real_escape_string($connection, $_POST['login']);
		$country  = mysqli_real_escape_string($connection, $_POST['country']);
		$email    = mysqli_real_escape_string($connection, $_POST['email']);
		$old_pass = mysqli_real_escape_string($connection, $_POST['old_pass']);
		$new_pass = mysqli_real_escape_string($connection, $_POST['new_pass']);
		$rpt_pass = mysqli_real_escape_string($connection, $_POST['rpt_pass']);
		$marry    = mysqli_real_escape_string($connection, $_POST['marry']);
		$publ_miss    = mysqli_real_escape_string($connection, $_POST['publ_miss']);
		$res_adr_st    = mysqli_real_escape_string($connection, $_POST['res_adr_st']);
		$res_adr_ph    = mysqli_real_escape_string($connection, $_POST['res_adr_ph']);
		$parents    = mysqli_real_escape_string($connection, $_POST['parents']);


		$errors = array();
		$error = false;

		if ( !empty($_FILES['avatar']['name']) )
		{
			$file = basename($_FILES['avatar']['name']);
			$uploaddir = "/var/www/html/studkurator/images/";
			$uploadfile = $uploaddir . $file;

			$uploaded = false;

			if ( $_FILES['avatar']['error']  == UPLOAD_ERR_OK )
			{
				move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);
				$uploaded = true;
				$image = "images/" . $file;
				$image_param = ",`avatar` = '$image'";
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

		if ( strlen($old_pass) > 0 && !password_verify($old_pass, $result['password']) )
		{
			$errors['pass'] = "Old password is incorrect!";
			$error = true;
		}

		if ( strlen($new_pass) > 0 && strlen($rpt_pass) > 0 && $new_pass != $rpt_pass )
		{
			$errors['pass'] = "New password doesn't match repeated password!";
			$error = true;
		}

		if ( strlen($login) == 0 || strlen($email) == 0 || strlen($country) == 0 )
		{
			$errors['info'] = "All fields should be filled!";
			$error = true;
		}

		if ( !$error && $uploaded && empty($errors) )
		{
			$password = password_hash($new_pass, PASSWORD_DEFAULT);
			$sql = "UPDATE `users` SET `email` = '$email', `login` = '$login', `password` = '$password', `country` = '$country' $image_param , `marr_status` = '$marry' , `publ_mission` = '$publ_miss' , `res_adress_study` = '$res_adr_st' , `res_adress_phone` = ' $res_adr_ph' , `parents` = '$parents' WHERE `id` = '$id'";
			mysqli_query($connection, $sql) or die(mysqli_error($connection));
			$_SESSION['logged_user']['login'] = $login;

			echo "<script type='text/javascript'>
					location.replace('index.php?action=profile&id=$id');
				</script>";
		}
	}
?>

<a onclick="window.history.back()" style="text-decoration: none;"><p id="back_button">Відмінити</p></a>
<div id="profile">
	
	<div id="profile_image">
		<img src="<?= $result['avatar'] ?>">
	</div>
	<form id='profile_info' enctype='multipart/form-data' accept='image' method='POST'>
		<input type='hidden' name='MAX_FILE_SIZE' value="300000000"/>
		<input type='file' name='avatar'>
		<br>
		<br>
		<?php 
			if ( $errors['info'] ) 
			{
				echo "<h2 style='color:red'>" . $errors['info'] . "</h2>";
			} 
		?>	
		Логін <input type='text' name="login" value="<?= $result['login'] ?>"><br>
		Країна <input type='text' name="country" value="<?= $result['country'] ?>"><br>
		Email <input type='text' name="email" value="<?= $result['email'] ?>"><br>
		Сімейний стан <input type='text' name="marry" value="<?= $result['marry'] ?>"><br>
		Громадське доручення <input type='text' name="publ_miss" value="<?= $result['publ_miss'] ?>"><br>
		<br>
		Адреса,де проживає під час навчання <input type='text' name="res_adr_st" value="<?= $result['res_adr_st'] ?>"><br>
		Домашня адреса і телефон<input type='text' name="res_adr_ph" value="<?= $result['res_adr_ph'] ?>"><br>
		Батьки<input type='text' name="parents" value="<?= $result['parents'] ?>"><br>
		<?php 
			if ( $errors['pass'] ) 
			{
				echo "<h2 style='color:red'>" . $errors['pass'] . "</h2>";
			} 
		?>
		Старий пароль <input name="old_pass" type='password'><br>
		Новий пароль <input name="new_pass" type='password'><br>
		Повторіть пароль <input name="rpt_pass" type='password'><br>
		<br>
		<br>
		<input type="submit" name="submit_edit" value="Зберегти">
	</form>

</div>