<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['mail-submit']))
{
    $errors=[];
    $success=[];
    $n_mail=$_POST['n-mail'];
    $n_mail_c=$_POST['n-mail-c'];
    $e_password=$_POST['e-password'];
    $s_n_mail=strip_tags($n_mail);
    $s_n_mail_c=strip_tags($n_mail_c);
    $s_e_password=strip_tags($e_password);
    $result=$db1::execute_query('SELECT user_email FROM user WHERE user_email LIKE :mail',[':mail' => $n_mail]);
    $number=$result->rowCount();
    $result0=$db1::execute_query('SELECT password FROM user WHERE user_id=:id',[':id' => $user->getid()]);
    $result1=$result0->fetch(PDO::FETCH_ASSOC);
    if(!isset($n_mail,$n_mail_c,$e_password))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($n_mail)||empty($n_mail_c)||empty($e_password))
    {
        array_push($errors,'Musí být vyplněna všechna pole.');
    }
    if($number!=0)
    {
        array_push($errors,'Zadaný email již někdo používá.');
    }
    if(!password_verify($s_e_password, $result1['password']))
    {
        array_push($errors,'Zadali jste špatné heslo, zkuste to znovu.');
    }
    if($s_n_mail != $s_n_mail_c)
    {
        array_push($errors,'E-maily se musí shodovat.');
    }
    if(strlen($n_mail)<=40 || strlen($n_mail_c)<=40)
    {
        array_push($errors,'Byla překročena maximální délka vstupu.');
    }
    if(empty($errors))
    {
        $result2=$user->changeMail($s_n_mail,$user->getid());
        if($result2)
        {
            array_push($success,'Váš e-mail byl úspěšně zmněněn.');
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
if(isset($_POST['pass-submit']))
{
    $errors=[];
    $success=[];
    $n_pass=$_POST['n-pass'];
    $n_pass_c=$_POST['n-pass-c'];
    $o_password=$_POST['o-password'];
    $s_n_pass=strip_tags($n_pass);
    $s_n_pass_c=strip_tags($n_pass_c);
    $s_o_password=strip_tags($o_password);
    $result=$db1::execute_query('SELECT password FROM user WHERE user_id=:id',[':id' => $user->getid()]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    if(!isset($n_pass,$n_pass_c,$o_password))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($n_pass)||empty($n_pass_c)||empty($o_password))
    {
        array_push($errors,'Musí být vyplněna všechna pole.');
    }
    if(!password_verify($s_o_password, $result0['password']))
    {
        array_push($errors,'Zadali jste špatné staré heslo, zkuste to znovu.');
    }
    if($s_n_pass != $s_n_pass_c)
    {
        array_push($errors,'Nové hesla se musí shodovat.');
    }
    if(empty($errors))
    {
        $result1=$user->changePass($s_n_pass,$user->getid());
        if($result1)
        {
            array_push($success,'Váše heslo bylo úspěšně zmněněno.');
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