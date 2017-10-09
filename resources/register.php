<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['r-submit']))
{
    $name=$_POST['r-username'];
    $pass=$_POST['password'];
    $passcheck=$_POST['check-password'];
    $mail=$_POST['e-mail'];
    $mailcheck=$_POST['check-e-mail'];
    $s_name=strip_tags($name);
    $s_pass=strip_tags($pass);
    $s_passcheck=strip_tags($passcheck);
    $s_mail=strip_tags($mail);
    $s_mailcheck=strip_tags($mailcheck);
    $result=$db1::execute_query('SELECT user_name FROM user WHERE user_name LIKE :name',[':name' => $s_name]);
    $number=$result->rowCount();
    $result0=$db1::execute_query('SELECT user_email FROM user WHERE user_email LIKE :mail',[':mail' => $s_mail]);
    $number0=$result0->rowCount();
    $errors=[];
    $success=[];
    if(!isset($pass, $passcheck, $mail, $mailcheck, $name))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($name)||empty($pass)||empty($passcheck)||empty($mail)||empty($mailcheck))
    {
        array_push($errors,'Musí být vyplněna všechna pole.');
    }
    if($s_pass !== $s_passcheck)
    {
        array_push($errors,'Hesla se musí shodovat.');
    }
    if($s_mail !== $s_mailcheck)
    {
        array_push($errors,'Emaily se musí shodovat.');
    }
    if(strlen($s_pass)<=4)
    {
        array_push($errors,'Vaše heslo musí být delší než 4 znaky.');
    }
    if(!strpos($s_mail,'@')||!strpos($s_mailcheck,'@')||!filter_var($s_mail, FILTER_VALIDATE_EMAIL)||!filter_var($s_mailcheck, FILTER_VALIDATE_EMAIL))
    {
        array_push($errors,'Není zadán e-mail.');
    }
    if($number!==0)
    {
        array_push($errors,'Uživatelské jméno již existuje.');
    }
    if($number0!==0)
    {
        array_push($errors,'Zadaný e-mail již existuje.');
    }
    if(strpos($name,' ')==true &&  strpos($mail,' ')==true && strpos($mailcheck,' ')==true)
    {
        array_push($errors,'V polích Uživatelské jméno a email nesmí být mezery.');
    }
    if(strlen($name)>20 && strlen($mail)>40 && strlen($mailcheck)>40)
    {
        array_push($errors,'Byla překročena maximální délka vstupu.');
    }
    if(empty($errors))
    {
        $result=$user->register($s_name, $s_pass, $s_mail);
        if($result)
        {
            array_push($success,'Byl jste úspěšně registrován.');
            $_SESSION['success']=$success;
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