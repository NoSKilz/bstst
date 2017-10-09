<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['pst']))
{
    $errors=[];
    $id=$_POST['product_id'];
    $s_id=strip_tags($id);
    $result=$db1::execute_query('SELECT product_name,price,in_stock FROM product WHERE product_id = :id',[':id' => $s_id]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    $number=$result->rowCount();
    if(!isset($id))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if($number<=0)
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if((int)$result0['in_stock']<=0)
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($errors))
    {
        $cart->add($result0);
        header('Refresh:0');
    }
    else
    {
        $_SESSION['errors']=$errors;
        header('Refresh:0');
    }
}