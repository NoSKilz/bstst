<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['pst']))
{
    $errors=[];
    if(!isset($_POST['product_id']))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    $id=$_POST['product_id'];
    $s_id=strip_tags($id);
    $result=$db1::execute_query('SELECT product_name,price,in_stock FROM product WHERE product_id = :id',[':id' => $s_id]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    $number=$result->rowCount();
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
        $item['name']=$result0['product_name'];
        $item['price']=$result0['price'];
        $item['count']=1;
        $_SESSION['cart'][]=$item;
        $result1=$_SESSION['cart'];
        $result2=[];
        foreach($result1 as $i)
        {
            $total_count+=$i['count'];
            $name=$i['name'];
            if(isset($result2[$name]))
            {
                $result2[$name]['count']+=$i['count'];
            }
            else
            {
                $result2[$name]=$i;
            }
        }
        $_SESSION['cart']=array_values($result2);
        $_SESSION['number']=$total_count;
        header('Refresh:0');
    }
    else
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
        $_SESSION['errors']=$errors;
        header('Refresh:0');
    }
}