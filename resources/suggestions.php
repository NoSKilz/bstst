<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    include_once '../classes/database.php';
    $db1=new database();
    $db=$db1::connect('localhost','project','root','');
    $text=$_POST['text'];
    $s_text=strip_tags($text);
    $output='';
    $sql="SELECT product_id,product_name,platform_name FROM product WHERE product_name LIKE '%$s_text%' ORDER BY product_name desc LIMIT 4";
    foreach($db->query($sql) as $row)
    {
        $output.="<a href='product.php?product={$row['product_id']}'>
                      <div class='suggest-text'>{$row['product_name']}    ({$row['platform_name']})</div>
                  </a>";
    }
    echo $output;