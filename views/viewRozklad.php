<div class="right-box">
	
	<?php
		
		if ( $_SESSION['logged_user']['admin'] == 1 )
		{
			
			echo "<a href='index.php?action=addRozklad' id='add_new_button'>Додати день</a>";
		}
	?>
</div>

<div id="recipes_list">
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

	$filename = $_SERVER['DOCUMENT_ROOT'] . "/cache/casherozkl.json";
  
	$sql = "SELECT * FROM `Rozklad` $condition ORDER BY `Day` DESC";

	if ( $_SESSION['visited'] == 0 )
	{
		$articles_amount_data = mysqli_query($connection, "SELECT COUNT(*) AS `Day` FROM `Rozklad`") or die(mysqli_error($connection));
		$articles_amount = mysqli_fetch_assoc($articles_amount_data);
		$amount = $articles_amount['Day'];
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
			
				
					echo "<div class='recipe'>";
				
				echo "	<div class='intro'>
							<p>" . $result[$i]['Day'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['first'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['second'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['thirth'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['fourth'] . "</p>
						</div>";
						
				if ( $_SESSION['logged_user']['admin'] == 1 )
				{
					echo "	<br>
							<br>
							<a href='index.php?action=editRozklad&id=" . $result[$i]['id'] . "'><h2>Редагувати</h2></a>
								<a href='index.php?action=deleteRozklad&id=" . $result[$i]['id'] . "'><h2>Видалити</h2></a>
							</div>";
				}
				else
				{
					echo "</div>";
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
			
					echo "<div class='recipe'>";
				
				
				echo "	<div class='intro'>
							<p>" . $result[$i]['Day'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['first'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['second'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['thirth'] . "</p>
						</div>
						<div class='intro'>
							<p>" . $result[$i]['fourth'] . "</p>
						</div>";
						

				if ( $_SESSION['logged_user']['admin'] == 1 )
				{
					echo "	<br>
							<br>
							<a href='index.php?action=editRozklad&id=" . $result[$i]['id'] . "'><h2>Редагувати</h2></a>
								<a href='index.php?action=delete&id=" . $result[$i]['id'] . "'><h2>Видалити</h2></a>
							</div>";
				}
				else
				{
					echo "</div>";
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