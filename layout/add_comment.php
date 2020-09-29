<?php

	require_once "db.php";

	$article_id = $_GET['article_id'];
	$author_id = $_GET['author_id'];
	$author_login = $_GET['author_login'];
	$text = addslashes($_GET['text']);
	$a = $_GET['a'];

	$sql = "INSERT INTO `comments` (`article_id`, `author_id`, `author_login`, `text`) VALUES ('$article_id', '$author_id', '$author_login', '$text')";

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

		if ( $a == 1 )
		{
			$responseText .= "<div class='comment_options'>
								<p onclick='deleteComment(" . $comments['id'] . ", " . $comments['article_id'] . ", $a)'>delete</p>
							</div>";
		}
				
		$responseText .= "</div>";
	}

	echo $responseText;	
		
?>