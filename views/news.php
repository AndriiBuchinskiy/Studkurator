 <div class="right-box">
	<?php
  
		if ( $_SESSION['logged_user']['admin'] == 1 )
		{
			echo "<a href='index.php?action=addarticle' id='add_new_button'>Додати новину</a>";
		}
	?>
</div>


<div class = "nav" id="recipes_list">
<?php
	
	if ( isset($_SESSION['visited']) )
	{
		$_SESSION['visited'] = 1;
	}
	else
	{
		$_SESSION['visited'] = 0;
	}

	$condition = ( $_SESSION['logged_user']['admin'] == 0) ? "WHERE `published` = 1" : "";

	$filename = $_SERVER['DOCUMENT_ROOT'] . "/cache/cacherecipes.json";
  
	$sql = "SELECT * FROM `news` $condition ORDER BY `date` DESC";

	if ( $_SESSION['visited'] == 0 )
	{
		$articles_amount_data = mysqli_query($connection, "SELECT COUNT(*) AS `amount` FROM `news`") or die(mysqli_error($connection));
		$articles_amount = mysqli_fetch_assoc($articles_amount_data);
		$amount = $articles_amount['amount'];
		$pages_amount = ($amount % 3) == 0 ? (int)($amount / 3) : (int)($amount / 3 + 1);

		$data = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		$temp = array();

		while ( $result = mysqli_fetch_assoc($data) )
		{
			$temp[] = $result;
		}

		$toJSON = json_encode($temp);

		file_put_contents($filename, $toJSON);

		$data = file_get_contents($filename) or die('wwwww');
		$result = json_decode($data, true);

		for ($i = 0; $i < 3; $i++)
		{
			if ( $result[$i] )
			{
				if ( $result[$i]['published'] == 0 && $_SESSION['logged_user']['admin'] == 1)
				{ 
					echo "<div class='recipe' style='background-color: green'>";
				}
				else 
				{
					echo "<div class='recipe'>";
				}
				
				echo "  
				        <div class='intro'>
							<p>" . $result[$i]['intro'] . "</p>
						</div>
						<a href='index.php?action=viewarticle&id=" . $result[$i]['id'] . "' class='link'><h2>Переглянути</h2></a>";

				if ( $_SESSION['logged_user']['admin'] == 1 )
				{
					echo "	<br>
							<br>
							<a href='index.php?action=edit&id=" . $result[$i]['id'] . "'><h2>Редагувати</h2></a>
								<a href='index.php?action=delete&id=" . $result[$i]['id'] . "'><h2>Видалити</h2></a>
							</div>";
				}
				else
				{
					echo "</div>";
				}
			}
			else
			{
				break;
			}
		}
	}
	else
	{

		$data = file_get_contents($filename);
		$result = json_decode($data, true);
		$amount = count($result);
		$pages_amount = ($amount % 3) == 0 ? (int)($amount / 3) : (int)($amount / 3 + 1);

		for ($i = 0; $i < 3; $i++) {
			if ( $result[$i] )
			{
				if ( $result[$i]['published'] == 0 && $_SESSION['logged_user']['admin'] == 1)
				{
					echo "<div class='recipe' style='background-color: green'>";
				}
				else 
				{
					echo "<div class='recipe'>";
				}
				

				echo "	
				        
						<div class='intro'>
							<p>" . $result[$i]['intro'] . "</p>
						</div>
						<a href='index.php?action=viewarticle&id=" . $result[$i]['id'] . "' class='link'><h2>Переглянути</h2></a>";

				if ( $_SESSION['logged_user']['admin'] == 1 )
				{
					echo "	<br>
							<br>
							<a href='index.php?action=edit&id=" . $result[$i]['id'] . "'><h2>Редагувати</h2></a>
								<a href='index.php?action=delete&id=" . $result[$i]['id'] . "'><h2>Видалити</h2></a>
							</div>";
				}
				else
				{
					echo "</div>";
				}
			}
			else
			{
				break;
			}
		}
	}

	$a = isset($_SESSION['logged_user']['admin']) ? $_SESSION['logged_user']['admin'] : 0 ;

	echo "	<br>
			<br>
				<div id='pages_list'>
					<ul id='pages'>
						<li style='opacity: 0.5'><-</li>";

	if ( $pages_amount < 5 )
	{
		for ($i = 0; $i < $pages_amount; $i++) {
			$temp = $i + 1;
			if ( $i == 0 )
			{
				echo "<li onclick=\"goToPage($i, $a, $pages_amount)\" style=\"background-color: green\">$temp</li>";
			}
			else
			{
				echo "<li onclick=\"goToPage($i, $a, $pages_amount)\">$temp</li>";
			}
		}
		echo "<li style='opacity: 0.5'>-></li>";
	}
	else
	{
		echo "<li style='opacity: 0.5'><-</li>";

		for ($i = 0; $i < 5; $i++) {
			$temp = $i + 1;
			if ( $i == 0 )
			{
				echo "<li onclick=\"goToPage($i, $a, $pages_amount)\" style=\"background-color: green\">$temp</li>";
			}
			else
			{
				echo "<li onclick=\"goToPage($i, $a, $pages_amount)\">$temp</li>";
			}
		}
		echo "<li onclick=\"goToPage(5, $a, $pages_amount)\">-></li>";
	}
			
	echo "</ul></div>";
?>

</div>