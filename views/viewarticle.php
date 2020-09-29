<a href='index.php?action=addarticle' style="text-decoration: none;"><p id="back_button">Назад</p></a>
<br>
<br>
<div class="right-box">
	<?php

		if ( $_SESSION['logged_user']['admin'] == 1 )
		{
			echo "<a href='index.php?action=addarticle' id='add_new_button'>Додати нову новину</a>";
		}
	?>
</div>
<?php

	$id = (int)$_GET['id']; 

	$dataContent = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = '$id'") or die(mysqli_error($connection));
	$dataComments = mysqli_query($connection, "SELECT * FROM `comments` WHERE `article_id` = '$id' ORDER BY `date` DESC") or die(mysqli_error($connection));
	

	if ( mysqli_num_rows($dataContent) == 0 )
	{
		echo "<h2 style='color: red'>Сторінка видалена або не створена!</h2>";
	}
	else 
	{
		$content = mysqli_fetch_assoc($dataContent);

		echo "		<div class='view_article'>
					
					<div class='article_image'>
						<img src='" . $content['image'] . "'>
					</div>
		            <div class='article_intro'>
						<p>" . $content['intro'] . "</p>
					</div>
					<div class='article_text'>
						<p>" . $content['text'] . "</p>
					</div>";

		if ( $_SESSION['logged_user'] )
		{
			echo "	<br>
					<h2>Коментарі:</h2><br>
					<div id='comments'>";
		}
		else
		{
			echo "	<br>
					<br>
					<h2>Коментарі:</h2><br>
					<div id='comments'>";
		}			

		while ( $comments = mysqli_fetch_assoc($dataComments) )
		{
			echo "	<div class='comment'> 
						<span class='comment_author'>
							<br>
							<a href='index.php?action=profile&id=" . $comments['author_id'] . "'>" . $comments['author_login'] . "</a>
						</span>
						<p id='" . $comments['id'] . "'>" . $comments['text'] . "</p>";

			if ( $_SESSION['logged_user']['admin'] == 1 )
			{
				echo "	<div class='comment_options'>
							<p onclick='deleteComment(" . $comments['id'] . ", " . $comments['article_id'] . ", " . $_SESSION['logged_user']['admin'] . ")'>delete</p>
						</div>";
			}
					
			echo "	</div>";
		}		

		echo "	</div>";

		if ( $_SESSION['logged_user'] )
		{
			echo "	<h2>Додати коментар:</h2><br>
					<textarea id='comment_field' name='text' placeholder='start typing..'></textarea>
					<button onclick=\"addComment(" . $id . ", " . $_SESSION['logged_user']['id'] . ", '" . $_SESSION['logged_user']['login'] . "', " . $_SESSION['logged_user']['admin'] . ")\">Додати коментар</button><br>";
		}
		else
		{
			echo "<p>please <a href='index.php?action=login'>log in</a> or <a href='index.php?action=registration'>Зареєструйтеся</a> щоб додати коментар</p>";
		}

		if ( $_SESSION['logged_user']['admin'] == 1 )
		{
			echo "	<a href='index.php?action=edit&id=" . $content['id'] . "'><h2>Редагувати</h2></a>
					<a href='index.php?action=delete&id=" . $content['id'] . "'><h2>Видалити</h2></a>
				</div>";
		}
		else
		{
			echo "</div>";
		}
	}

?>
