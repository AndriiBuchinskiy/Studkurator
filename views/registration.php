<div id="signup_box">
	<?php
		if ( !empty($_POST) )
		{
			$errors = array();

			$regExpLogin = '/^[\p{L}\d_-]{4,}$/u';
			$regExpPassLowerCase = '/[a-z]/';
			$regExpPassUpperCase = '/[A-Z]/';
			$regExpPassDigit = '/\d/';
			$regExpEmail = '/^[a-zA-Z0-9-_\.]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/';
			$regExpSurname ='/^[\p{L}\d_-]{4,}$/u';
			$regExpName ='/^[\p{L}\d_-]{4,}$/u';
			$regExpGroups = '/^[0-9]/';
			$regExpCity = '/^[\p{L}\d_-]{4,}$/u';
			$regExpStudyform = '/^[\p{L}\d_-]{4,}$/u';

			$login = $_POST['login'];
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$rpt_pass = $_POST['repeat_password'];
			$country = $_POST['country'];
			$surname = $_POST['surname'];
			$name = $_POST['name'];
			$groups = $_POST['groups'];
			$city = $_POST['city'];
			$studyform = $_POST['studyform'];

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
				$errors['name'] = "Name should not contain non word characters!";
			} 
            
            if ( !preg_match($regExpGroups, $groups) )
			{
				$errors['groups'] = "Groups should not contain non word characters!";
			}
			
			if ( !preg_match($regExpCity, $city) )
			{
				$errors['city'] = "Login should not contain non word characters!";
			}
           
           if ( !preg_match($regExpStudyform, $studyform) )
			{
				$errors['studyform'] = "Login should not contain non word characters!";
			}
			if ( empty($errors) )
			{
				$sql = "SELECT * FROM `users` WHERE `email` = '$email' OR `login` = '$login'";
				$sqli = "SELECT * FROM `Students` WHERE `surname` = '$surname' OR `name` = '$name' OR `groups` = '$groups' OR `city` = '$city' OR `studyform` = '$studyform'";
				

				$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				$data1 = mysqli_query($connection, $sqli) or die(mysqli_error($connection));
				if ( mysqli_num_rows($data) > 0 )
				{
					$errors['reg_error'] = "User with this email or login is registered!";
				}
				else
				{
					$password = password_hash($pass, PASSWORD_DEFAULT);
					$sql = "INSERT INTO `users` (`email`, `login`, `password`, `country`,`surname`,`name`,`groups`,`city`,`studyform`) VALUES ('$email', '$login', '$password', '$country','$surname','$name','$groups','$city','$studyform')";
					
					mysqli_query($connection, $sql) or die(mysqli_error($connection));
					mysqli_query($connection, $sqli) or die(mysqli_error($connection));
					

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
		<p class="country_select">Країна</p>
		
		<?php

			$data =  file_get_contents("layout/source.json");
			$list = json_decode($data, true);
			echo "<select required name='country'>";
			foreach ($list as $key => $value) {
				echo "<option value='" . $key . "'>" . $value . "</option>";
			}
			echo "</select>";

		?>
        <label><p class="login_text">Прізвище</p></label>
		<input type="text" name="surname" value="<?= !empty($_POST)?$surname:"" ?>" required>
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
         <label><p class="login_text">Група</p></label>
		<input type="text" name="groups" value="<?= !empty($_POST)?$groups:"" ?>" required>
		<?php 

			if ( $errors['groups'] )
			{
				echo "<h2 style='color: red'>" . $errors['groups'] . "</h2><br>";
			}
         
		?>
        <label><p class="login_text">Місце проживання</p></label>
		<input type="text" name="city" value="<?= !empty($_POST)?$city:"" ?>" required>
		<?php 

			if ( $errors['city'] )
			{
				echo "<h2 style='color: red'>" . $errors['city'] . "</h2><br>";
			}

		?>
		<label><p class="login_text">Форма навчання</p></label>
		<input type="text" name="studyform" value="<?= !empty($_POST)?$studyform:"" ?>" required>
		<?php 

			if ( $errors['studyform'] )
			{
				echo "<h2 style='color: red'>" . $errors['studyform'] . "</h2><br>";
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
 