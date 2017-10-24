<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author NoSkilz
 */
class user
{
    private $name,$logged,$id,$database;
    public function __construct($database)
    {
        $this->database = $database;
    }
    public function register($name,$password,$mail)
    {
        $options=['cost'=>12];
        $hash=password_hash($password, PASSWORD_BCRYPT, $options);
        $result=$this->database::execute_query('INSERT INTO user(user_name,password,joined,user_email) VALUES(:username,:password,Now(),:email)',[":username"=>$name,":password"=>$hash,":email"=>$mail]);
        return $result;
    }
    public function login($name)
    {
        $result=$this->database::execute_query('SELECT user_id,user_name FROM user WHERE user_name LIKE :username',[':username'=>$name]);
        $result0=$result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['logged']=1;
        $_SESSION['username']=$result0['user_name'];
        $_SESSION['user_id']=$result0['user_id'];
        return $result0;
    }
    public function logout()
    {
        $location=substr($_SERVER['REQUEST_URI'],0,-14);
        unset($_SESSION['logged'],$_SESSION['username'],$_SESSION['user_id']);
        $this->id=$this->logged=$this->name=NULL;
        header("Location: $location");
    }
    public function changeMail($mail,$id)
    {
        $result=$this->database::execute_query('UPDATE user SET user_email=:nmail WHERE user_id=:id',[':nmail' => $mail,':id' => $$id]);
        return $result;
    }
    public function changePass($pass,$id)
    {
        $options=['cost'=>12];
        $hash=password_hash($pass, PASSWORD_BCRYPT, $options);
        $result=$this->database::execute_query('UPDATE user SET password=:pass WHERE user_id=:id',[':pass' => $hash,':id' => $id]);
        return $result;
    }
    public function loggedin() 
    {
        if($_SESSION['logged']==1)
        {
            $loggedin=true;
            return $loggedin;
        }
        else 
        {
            $loggedin=false;
            return $loggedin;
        }
    }
    public function getid() 
    {
        $this->id=$_SESSION['user_id'];
        return $this->id;    
    }
    public function getlogged() 
    {
        $this->logged=$_SESSION['logged'];
        return $this->logged;    
    }
    public function getname() 
    {
        $this->name=$_SESSION['username'];
        return $this->name;    
    }
}
