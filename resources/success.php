<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['success'])&&!empty($_SESSION['success']))
{
    echo '<div id="success" style="display: block;">
                  <span class="closesc">&times;</span>';
    foreach ($_SESSION['success'] as $success)
    {
        echo "<p>$success</p>";
    }
    echo '</div>';
    if(isset($_SESSION['success_unset'],$_SESSION['success'])&&!empty($_SESSION['success'])&&!empty($_SESSION['success_unset']))
    {
        unset($_SESSION['success']);
        unset($_SESSION['success_unset']);
    }
    if(isset($_SESSION['success']))
    {
        $_SESSION['success_unset']=true;
    }
}