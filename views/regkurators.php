<div id="signup_box">
	<?php

        setlocale(LC_ALL, "ua_UA.UTF-8");
		if ( !empty($_POST) )
		{
			$errors = array();

			$regExpLogin = '/^[\p{L}\d_-]{4,}$/u';
			$regExpPassLowerCase = '/[a-z]/';
			$regExpPassUpperCase = '/[A-Z]/';
			$regExpPassDigit = '/\d/';
			$regExpEmail = '/^[a-zA-Z0-9-_\.]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/';
			$regExpSurname ='/^[A-Za-z0-9а-яА-Я]/u';
			$regExpName ='/^[A-Za-z0-9а-яА-Я]/u';
			$regExpMidle_name = '/^[A-Za-z0-9а-яА-Я]/u';
			$regExpGroups = '/^[0-9]/';


			$login = $_POST['login'];
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$rpt_pass = $_POST['repeat_password'];
			$surname = $_POST['surname'];
			$name = $_POST['name'];
			$middle_name = $_POST['Middle_name'];
			$groups = $_POST['groups'];


			if ( !preg_match($regExpLogin, $login) )
			{
				$errors['login'] = "Login should not contain non word characters!";
			}
			if ( !preg_match($regExpEmail, $email) )
			{
				$errors['email'] = "Bad email!";
			}
			if ( !preg_match($regExpPassLowerCase, $pass) || !preg_match($regExpPassUpperCase, $pass) || !preg_match($regExpPassDigit, $pass) || strlen($pass) < 7)
			{
				$errors['password'] = "Password should not contain non word characters and have at least length of 7!";
			}
			if ( $pass != $rpt_pass)
			{
				$errors['rpt_password'] = "Password doesn't match repeated password!";
			}
             
             
             if ( !preg_match($regExpSurname, $surname) )
			{
				$errors['surname'] = "Surname should not contain non word characters!";
			}
             
            if ( !preg_match($regExpName, $name) )
			{
				$errors['Name'] = "Name should not contain non word characters!";
			} 
			if ( !preg_match($regExpMidle_name, $middle_name) )
			{
				$errors['Middle_name'] = "Middle_name should not contain non word characters!";
			}

            
            if ( !preg_match($regExpGroups, $groups) )
			{
				$errors['groups'] = "Groups should not contain non word characters!";
			}
			
           
			if ( empty($errors) )
			{
				$sql = "SELECT * FROM `users` WHERE `email` = '$email' OR `login` = '$login'";
				$saq = "SELECT * FROM `Kurators` WHERE `surname` = '$surname' OR `name` = '$name' OR `Middle_name` = '$middle_name' OR `groups` = '$groups'";

				$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				if ( mysqli_num_rows($data) > 0 )
				{
					$errors['reg_error'] = "User with this email or login is registered!";
				}
				else
				{
					$password = password_hash($pass, PASSWORD_DEFAULT);
					$sql = "INSERT INTO `users` (`email`, `login`, `password`, `country`) VALUES ('$email', '$login', '$password')";
					$saq = "INSERT INTO `Kurators` (`surname`,`name`,`Middle_name`,`groups`) VALUES ('$surname','&name','$middle_name','$groups')";
					mysqli_query($connection, $sql) or die(mysqli_error($connection));
				}
			}
		}
	?>
	
	<form method="POST">
		<?php 

			if ($errors['reg_error'])
			{
				echo "<h2 style='color: red'>" . $errors['reg_error'] . "</h2><br>";
			}

		?>
		<label><p class="email_text">email</p></label>
		<input type="email"  name="email" value="<?= !empty($_POST)?$email:"" ?>" required>
		<?php 

			if ( $errors['email'] )
			{
				echo "<h2 style='color: red'>" . $errors['email'] . "</h2><br>";
			}

		?>
		<label><p class="login_text">login</p></label>
		<input type="text" name="login" value="<?= !empty($_POST)?$login:"" ?>" required>
		<?php 

			if ( $errors['login'] )
			{
				echo "<h2 style='color: red'>" . $errors['login'] . "</h2><br>";
			}

		?>
		<label><p class="pass_text">Пароль</p></label>
		<input type="password" name="password" required>
		<?php 

			if ( $errors['password'] )
			{
				echo "<h2 style='color: red'>" . $errors['password'] . "</h2><br>";
			}

		?>
		<label><p class="rpt_text">Повторіть пароль</p></label>
		<input type="password" name="repeat_password">
		<?php 

			if ( $errors['rpt_password'] )
			{
				echo "<h2 style='color: red'>" . $errors['rpt_password'] . "</h2><br>";
			}

		?>
		<br>
	
        <label><p class="login_text">Прізвище</p></label>
		<input type="text" name="Surname" value="<?= !empty($_POST)?$surname:"" ?>" required>
		<?php 

			if ( $errors['surname'] )
			{
				echo "<h2 style='color: red'>" . $errors['surname'] . "</h2><br>";
			}

		?>
		<label><p class="login_text">Ім'я</p></label>
		<input type="text" name="name" value="<?= !empty($_POST)?$name:"" ?>" required>
		<?php 

			if ( $errors['name'] )
			{
				echo "<h2 style='color: red'>" . $errors['name'] . "</h2><br>";
			}

		?>
         <label><p class="login_text">По батькові</p></label>
		<input type="text" name="middle_name" value="<?= !empty($_POST)?$middle_name:"" ?>" required>
		<?php 

			if ( $errors['middle_name'] )
			{
				echo "<h2 style='color: red'>" . $errors['Middle_name'] . "</h2><br>";
			}
         
		?>
        <label><p class="login_text">Номер академічної групи</p></label>
		<input type="text" name="groups" value="<?= !empty($_POST)?$groups:"" ?>" required>
		<?php 

			if ( $errors['groups'] )
			{
				echo "<h2 style='color: red'>" . $errors['groups'] . "</h2><br>";
			}

		?>
		
		<?php
			if ( isset($_POST['submit']) && empty($errors) )	
			{?>
				<script type="text/javascript">
  					location.replace("index.php?action=registration-successfull");
				</script>
			<?php	
			}
		?>
     
		<br><br>
		<input id="register_button" name="submit" type="submit" value="REGISTER">
	</form>	
</div>
 