<?php

	require_once "db.php";

	$id = $_GET['id'];
	$text = $_GET['text'];

	$sql = "UPDATE `comments` SET `text` = '$text' WHERE `id` = '$id'";
	mysqli_query($connection, $sql) or die(mysqli_error($connection));

	$sql = "SELECT `text` FROM `comments` WHERE `id` = '$id'";

	$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	$result = mysqli_fetch_assoc($data);

	$responseText = $result['text'];

	echo $responseText;

?>