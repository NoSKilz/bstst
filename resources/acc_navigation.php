<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($platforms as $row)
{
    echo "<button class='accordion'>{$row['platform_name']}</button>
            <div class='panel'>
            <ul class='genre-ul'>";
            
            foreach($genres as $row0)
            {
               echo "<li class='genre'><a href='result.php?platform={$row['platform_name']}&genre={$row0['genre_name']}'>{$row0['genre_name']}</a></li>";
            }
    echo '</ul></div>';
}