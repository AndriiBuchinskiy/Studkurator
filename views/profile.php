<?php

	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
	$data = mysqli_query($connection, $sql) or die(myseli_error($connection));
	$result = mysqli_fetch_assoc($data);

?>
<a onclick="window.history.back()" style="text-decoration: none;"><p id="back_button">Назад</p></a>
<div id="profile">
	
	<div id="profile_image">
		<img src="<?= $result['avatar'] ?>">
	</div>
	<br>
	<br>
	<div id="profile_info">		
		<h3 id="profile_login"><?= $result['login'] ?></h3>
		<h3 id="profile_country"><?= $result['country'] ?></h3>
	</div>	
	<br>
	<br>
	<?php
		if ( $_SESSION['logged_user']['id'] == $id )
		{
			echo "<h3 id='profile_edit'><a href='index.php?action=editprofile&id=$id'>Редагувати профіль</a></h3>";
		}
	?>
</div>