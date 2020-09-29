<br>
<a onclick="window.history.back()" style="text-decoration: none;"><p id="back_button">Назад</p></a>
<br>

       <div class="right-box">
       	<?php
		if ( $_SESSION['logged_user']['admin'] == 1 )
		{
			echo "<a href='index.php?action=addRozklad' id='add_new_button'>Додати новий розклад</a>";
		}
		?>
	   </div>	
<?php

    $dataContent = mysqli_query($connection, "SELECT * FROM `Rozklad`") or die(mysqli_error($connection));
	if ( mysqli_num_rows($dataContent) == 0 )
	{
		echo "<h2 style='color: red'>This page has been deleted or not created yet!</h2>";
	}
	else 
	{
		$content = mysqli_fetch_assoc($dataContent);
       
		echo "	<div class='view_article'>
		            <div class='article_intro'>
						<p>" . $content['Day'] . "</p>
					<div class='article_intro'>
						<p>" . $content['first'] . "</p>
					</div>
					<div class='article_intro'>
						<p>" . $content['second'] . "</p>
					</div>
					<div class='article_intro'>
						<p>" . $content['thirth'] . "</p>
					</div>
					<div class='article_intro'> 
						<p>" . $content['fourth'] . "</p>
					</div>";


		if ( $_SESSION['logged_user']['admin'] == 1 ) 
		{
			echo "	<a href='index.php?action=editRozklad$id=" . $content['id'] . "'><h2>Редагувати</h2></a>
					<a href='index.php?action=deleteRozklad&id=" . $content['id'] . "'><h2>Видалити</h2></a>
				</div>";
		}
		else
		{
			echo "</div>";
		}
	}

?>
