
<!--<div id="Ttable">
    <div class="right-box">
    <?php

  //      if ( $_SESSION['logged_user']['admin'] == 1 )
        {
    //        echo "<a href='index.php?action=editSt_vidvd' id='add_new_button'>Редагувати</a>";
        }
    ?>
</div>
-->
<div  id="Ttable" >
<?php
 // подключаем скрипт
 

     
$query ="SELECT id_st,PIP,september,october,november,december,january FROM Stud_vidvd";
 
$result = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    echo "<table><tr><th>Id</th><th>ПІП</th><th>Вересень</th><th>Жовтень</th><th>Листопад</th><th>Грудень</th><th>Січень</th></tr>";

    for ($i = 0 ; $i < 10 ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 10 ; ++$j) echo "<td>$row[$j] </td>";
        echo "</tr>";
    }
    echo "</table>";
     
    // очищаем результат
    mysqli_free_result($result);
}
 

?>
</div>
