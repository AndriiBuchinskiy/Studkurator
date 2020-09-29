<div class="right-box">
    <?php

        if ( $_SESSION['logged_user']['admin'] == 1 )
        {
            echo "<a href='index.php?action=addPlan' id='add_new_button'>Новий день</a>";
        }
    ?>
</div>
<div id="Ttable">


<?php
$query ="SELECT  id_st,PIP,september,october,november,december,january FROM Stud_vidvd";
$result = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    echo "<table><tr><th>Id</th><th>Захід</th><th>Дата викон.</th><th>Відповідальний</th><th>Примітка</th>";

    for ($i = 1 ; $i < 10 ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 1 ; $j < 10 ; ++$j) 
            	{
            	 print( "<td> <input type="radio", name="fdw", value= "$row[$j]" </td>");
                }
        echo "</tr>";
    }
    echo "</table>";
     
    // очищаем результат
    mysqli_free_result($result);
}
?>
</div>
