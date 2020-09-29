<div id="login_box">
	
	<?php

		if ( !empty($_POST) )
		{
			$login = mysqli_real_escape_string($connection, $_POST['login']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);

			$logged = false;

			$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
			$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( mysqli_num_rows($result) == 0 )
			{
				echo "<h2 style='color: red'>Incorrect login or password!</h2>";
			}
			else
			{
				$data = mysqli_fetch_assoc($result);

				if ( password_verify($password, $data['password']) )
				{	
					$user = array(
						"login" => $data['login'],
						"id" => $data['id'],
						"admin" => $data['admin']
					);
					$_SESSION['logged_user'] = $user;
					$logged = true;
				}
				else
				{
					echo "<h2 style='color: red'>Incorrect login or password!</h2>";
				}
			}
		}

	?>

	<form method="POST">
		<p class="email_text">Логін</p>
		<input type="text"  name="login" required>
		<p class="pass_text">Пароль</p>
		<input type="password" name="password" required>
		<br><br>
		<button type="submit" name="submit">Увійти</button>
	</form>	

	<?php
		if ( isset($_POST['submit']) && $logged )	
		{?>
			<script type="text/javascript">
				location.replace("index.php");
			</script>
		<?php	
		}
	?>

</div>