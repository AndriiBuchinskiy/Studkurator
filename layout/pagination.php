<?php

	$page = (int)$_GET['page'];
	$a = (int)$_GET['admin'];
	$pages_amount = (int)$_GET['amount'];

	$filename = $_SERVER['DOCUMENT_ROOT'] . "/cache/cacherecipes.json";
	$skip = $page * 3;
	$end = $skip + 3;

	$responseText = "";

	$data = file_get_contents($filename);
	$result = json_decode($data, true);

	for ($i = $skip; $i < $end; $i++) {
		if ( $result[$i] )
		{
			if ( $result[$i]['published'] == 0 && $a == 1)
			{
				$responseText .= "<div class='recipe'>";
			}
			else 
			{
				$responseText .= "<div class='recipe'>";
			}
			
			$responseText .= "	
					<div class='intro'>
						<p>" . $result[$i]['intro'] . "</p>
					</div>
					<a href='index.php?action=viewarticle&id=" . $result[$i]['id'] . "' class='link'><h2>Переглянути</h2></a>";

			if ( $a == 1 )
			{
				$responseText .= "	<br>
						<br>
						<a href='index.php?action=edit&id=" . $result[$i]['id'] . "'><h2>Редагувати</h2></a>
							<a href='index.php?action=delete&id=" . $result[$i]['id'] . "'><h2>Видалити</h2></a>
						</div>";
			}
			else
			{
				$responseText .= "</div>";
			}
		}
		else
		{
			break;
		}
	}

	$responseText .= "	<br>
						<br>
						<div id='pages_list'>
							<ul id='pages'>";

	if ( $page < 5 )
	{
		$responseText .= "<li style='opacity: 0.5'><-</li>";
		for ($i = 0; $i < $pages_amount; $i++) {
			$temp = $i + 1;
			if ( $i == $page )
			{
				$responseText .= "<li onclick=\"goToPage($i, $a, $pages_amount)\" style=\"background-color: green\">$temp</li>";
			}
			else
			{
				$responseText .= "<li onclick=\"goToPage($i, $a, $pages_amount)\">$temp</li>";
			}
		}
		$responseText .= "<li style='opacity: 0.5'>-></li>";
	}
	else
	{
		$prev = $page - 5;
		$next =  $page + 1;
		$responseText .= "<li onclick=\"goToPage($prev, '$category', $a)\"><-</li>";
		for ($i = $page - 4; $i <= $page; $i++) {
			$temp = $i + 1;
			if ( $i == $page )
			{
				$responseText .= "<li onclick=\"goToPage($i, $a, $pages_amount)\" style=\"background-color: green\">$temp</li>";
			}
			else
			{
				$responseText .= "<li onclick=\"goToPage($i, $a, $pages_amount)\">$temp</li>";
			}
		}
		$responseText .= "<li onclick=\"goToPage($next, $a, $pages_amount)\">-></li>";
	}
			
	$responseText .= "</ul></div>";

	echo $responseText;
?>