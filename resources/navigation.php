<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$platforms=$db1::execute_fetchall('SELECT platform_name FROM platform');
$genres=$db1::execute_fetchall('SELECT genre_name FROM genre');
foreach ($platforms as $row)
{
    echo "<li class='platform'><a href='#'>{$row['platform_name']}</a>
            <ul class='genre-ul'>";
            foreach($genres as $row0)
            {
               echo "<li class='genre'><a href='result.php?platform={$row['platform_name']}&genre={$row0['genre_name']}'>{$row0['genre_name']}</a></li>";
            }
        echo '</ul>
          </li>';
}