<?php

	require_once "db.php";

	$id = $_GET['id'];
	$article_id = $_GET['article_id'];
	$admin = $_GET['a'];

	$sql = "DELETE FROM `comments` WHERE `id` = '$id'";
	mysqli_query($connection, $sql) or die(mysqli_error($connection));

	$sql = "SELECT * FROM `comments` WHERE `article_id` = '$article_id' ORDER BY `date` DESC";
	$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));

	while ( $comments = mysqli_fetch_assoc($data) )
	{
		$responseText .= "<div class='comment'>
							<span class='comment_author'>
								<br>
								<a href='index.php?action=profile&id=" . $comments['author_id'] . "'>" . $comments['author_login'] . "</a>
							</span>
							<p id='" . $comments['id'] . "'>" . $comments['text'] . "</p>";

		if ( $admin == 1 )
		{
			$responseText .= "<div class='comment_options'>
								<p onclick='deleteComment(" . $comments['id'] . ", " . $comments['article_id'] . ", $admin)'>delete</p>
							</div>";
		}
				
		$responseText .= "</div>";
	}

	echo $responseText;	

?>