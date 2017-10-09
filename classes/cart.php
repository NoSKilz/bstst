<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cart
 *
 * @author NoSkilz
 */
class cart 
{
    protected $item=[];
    public function some_name($cart_session)
    {
        $result=$cart_session;
        $result0=[];
        $total_count;
        foreach($result as $i)
        {
            $total_count+=$i['count'];
            $name=$i['name'];
            if(isset($result0[$name]))
            {
                $result0[$name]['count']+=$i['count'];
            }
            else
            {
                $result0[$name]=$i;
            }
        }
        $_SESSION['number']=$total_count;
        return $result0;
    }
    public function add($product)
    {
        $this->item['name']=$product['product_name'];
        $this->item['price']=$product['price'];
        $this->item['count']=1;
        $_SESSION['cart'][]=$this->item;
        $result=$this->some_name($_SESSION['cart']);
        $_SESSION['cart']=array_values($result);
    }
    public function remove()
    {
        foreach($_SESSION['cart'] as $i => $item )
        {
            if($_SESSION['cart'][$i]['name']==$_GET['delete'])
            {
                unset($_SESSION['cart'][$i]);
            }
        }
        $i=0;
        foreach($_SESSION['cart'] as $i => $item )
        {
            $i++;
        }
        if($i==0||$i==1)
        {
            unset($_SESSION['cart']);
        }
    }
}
