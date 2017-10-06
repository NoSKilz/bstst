<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sql='SELECT platform_name FROM platform';
foreach ($db->query($sql) as $row)
{
    echo "<li class='platform'><a href='#'>{$row['platform_name']}</a>
            <ul class='genre-ul'>";
            $sql='SELECT genre_name FROM genre';
            foreach($db->query($sql) as $row0)
            {
               echo "<li class='genre'><a href='result.php?platform={$row['platform_name']}&genre={$row0['genre_name']}'>{$row0['genre_name']}</a></li>";
            }
        echo '</ul>
          </li>';
}