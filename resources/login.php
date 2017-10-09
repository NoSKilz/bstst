<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['l-submit']))
{
    $name=$_POST['l-username'];
    $pass=$_POST['l-password'];
    $s_name=strip_tags($name);
    $s_pass=strip_tags($pass);
    $result=$db1::execute_query('SELECT password FROM user WHERE user_name LIKE :username',[':username' => $s_name]);
    $number=$result->rowCount();
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    $errors=[];
    if(!isset($name,$pass))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($name)||empty($pass))
    {
        array_push($errors,'Musí být vyplněna všechna pole.');
    }
    if(strlen($name)>20)
    {
        array_push($errors,'Byla překročena maximální délka vstupu.');
    }
    if(!password_verify($s_pass,$result0['password'])||$number==0)
    {
        array_push($errors,'Zadali jste špatné jméno nebo heslo.');
    }
    if(empty($errors))
    {
        $result=$user->login($s_name);
        if($result)
        {
            header('Refresh:0');
        }
        else
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
            $_SESSION['errors']=$errors;
            header('Refresh:0');
        }
    }
    else
    {
        $_SESSION['errors']=$errors;
        header('Refresh:0');
    }
}