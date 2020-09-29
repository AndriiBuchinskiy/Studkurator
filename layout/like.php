<?php

	require_once "db.php";

	$article_id = $_GET['article_id'];
	$author_id = $_GET['author_id'];

	$sql = "SELECT * FROM `likes` WHERE `article_id` = '$article_id' AND `author_id` = '$author_id'";
	$result = mysqli_query($connection, $sql);

	if ( mysqli_num_rows($result) > 0 )
	{
		$sql = "DELETE FROM `likes` WHERE `article_id` = '$article_id' AND `author_id` = '$author_id'";
		mysqli_query($connection, $sql) or die(mysqli_error($connection));

		$sql = "SELECT COUNT(*) FROM `likes` WHERE `article_id` = '$article_id'";
		$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		$result = mysqli_fetch_array($data);
		echo "&#9829; " . $result[0];
	}
	else
	{
		$sql = "INSERT INTO `likes` (`author_id`, `article_id`) VALUES ('$author_id', '$article_id')";
		mysqli_query($connection, $sql) or die(mysqli_error($connection));

		$sql = "SELECT COUNT(*) FROM `likes` WHERE `article_id` = '$article_id'";
		$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		$result = mysqli_fetch_array($data);
		echo "&#9829; " . $result[0];
	}

?>