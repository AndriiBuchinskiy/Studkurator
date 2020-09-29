<?php

	$login = $_SESSION['logged_user']['login'];
	$id = $_SESSION['logged_user']['id'];

?>
<nav>
	<ul id="setup">
		<br>
		<li><a href="index.php" id="SIGN_UP_BTN">Домашня</a></li>
		<br>
		<li><a href="index.php?action=news" id="SIGN_UP_BTN">Новини</a></li>
		<br>
		<li><a href="index.php?action=Studentsview" id="SIGN_UP_BTN">Студенти</a></li>
		<br>
		<li><a href="index.php?action=viewRozklad" id="SIGN_UP_BTN">Розклад</a></li>
		<br>
		<li><a href="index.php?action=St_vidv_views" id="SIGN_UP_BTN">Відвідування</a></li>
		<br>
		<li><a href="index.php?action=plans" id="SIGN_UP_BTN">Заходи</a></li>
		<br>
		<li><a href="index.php?action=Posyll" id="SIGN_UP_BTN">Корисні посилання</a></li>
		<br>
		<li><a href="index.php?action=logout" id="SIGN_UP_BTN">Вихід</a></li>
		<br>	
		<li><a href="index.php?action=profile&id=<?= $id ?>" id="SIGN_IN_BTN"><?= $login ?></a></li>		
		<br>
	</ul>
</nav>