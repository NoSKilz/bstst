<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['c-submit']))
{
    $comm=$_POST['comment'];
    $s_comm=strip_tags($comm);
    $s_product=strip_tags($_GET['product']);
    $errors=[];
    if(!$user->loggedin())
    {
        array_push($errors,'K přidání komentáře musíte být přihlášeni.');
    }
    if(!isset($comm)||empty($comm))
    { 
        array_push($errors,'Musí být vyplněna všechna pole.');
    }
    if(strlen($s_comm)>=500)
    {
        array_push($errors,'Byla překročena maximální délka vstupu.');
    }
    if(empty($errors))
    {
        $result=$db1::execute_query('INSERT INTO comments(user_id,product_id,comment_text,uploaded) VALUES(:id,:pid,:text,Now())',[':id' => $user->getid(),
                                  ':pid' => $s_product,
                                  ':text' => $s_comm]);
        header('Refresh:0');
        if(!$result)
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to znovu.');
            $_SESSION['errors']=$errors;
            header('Refrsh:0');
        }   
    }
    else
    {
        $_SESSION['errors']=$errors;
    }
}