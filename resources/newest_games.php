<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$result=$db1::execute_fetchall('SELECT product_id,product_name,platform_name,price,picture,description FROM product ORDER BY uploaded desc LIMIT 8 OFFSET 0'); 
foreach($result as $row)
{
    $description=mb_strimwidth($row['description'],0,200);
    echo "<a href='product.php?product={$row['product_id']}'><div class='new-prod'>
        <div class='flip'>
          <div class='front'>
          <img src='images/{$row['picture']}' alt='Obrázek pro hru {$row['product_name']}'>
          <p class='name'>{$row['product_name']} ({$row['platform_name']})</p>
          <p class='price'>{$row['price']} Kč</p>
          </div>
          <div class='back'>$description...</div>
        </div>
      </div></a>";
}