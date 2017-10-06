<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$i=0;
$sql='SELECT product_id,product_name,platform_name,price FROM product ORDER BY sold desc LIMIT 20 OFFSET 0';
foreach ($db->query($sql) as $row)
    {
        $i++;
        echo "<div class='product'>
                <a href='product.php?product={$row['product_id']}'>
                <p class='p-name'>$i  {$row['product_name']}  ({$row['platform_name']})</p>
                <p class='p-price'>{$row['price']} Kč</p>
                </a>
              </div>";
    }