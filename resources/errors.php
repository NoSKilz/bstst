<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['errors'])&&!empty($_SESSION['errors']))
{
    echo '<div id="errors" style="display: block;">
                  <span class="closeerr">&times;</span>';
    foreach ($_SESSION['errors'] as $error)
    {
        echo "<p>$error</p>";
    }
    echo '</div>';
    if(isset($_SESSION['err_unset'],$_SESSION['errors'])&&!empty($_SESSION['errors'])&&!empty($_SESSION['err_unset']))
    {
        unset($_SESSION['errors']);
        unset($_SESSION['err_unset']);
    }
    if(isset($_SESSION['errors']))
    {
        $_SESSION['err_unset']=true;
    }
}