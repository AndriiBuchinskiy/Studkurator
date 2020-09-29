<div id="Ttable">
<?php
 // подключаем скрипт
 

     
$query ="SELECT id,surname,name,groups,city,studyform,marr_status,publ_mission FROM users";
 
$result = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    echo "<table><tr><th>Id</th><th>Прізвище</th><th>Ім'я</th><th>Група</th><th>Місце проживання</th><th>Форма навчання</th><th>Сімейний стан</th><th>Громадське доручення</th></tr>";

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
