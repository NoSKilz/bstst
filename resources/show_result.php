<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_GET['genre'],$_GET['platform']))
{
    $genre=$_GET['genre'];
    $platform=$_GET['platform'];
    $s_genre=strip_tags($genre);
    $s_platform=strip_tags($platform);
    $result=$db1::execute_query('SELECT genre_name FROM genre WHERE genre_name=:name',[':name' => $s_genre]);
    $number=$result->rowCount();
    $result0=$db1::execute_query('SELECT platform_name FROM platform WHERE platform_name=:name',[':name' => $s_platform]);
    $number0=$result0->rowCount();
    if($number>0 && $number0>0)
    {
        $result1=$db1::execute_fetchall('SELECT product_id,product_name,price,platform_name FROM product WHERE(genre_name LIKE :genname AND platform_name LIKE :platname) LIMIT 30',[':genname' => $s_genre,
                                ':platname' => $s_platform]);
        if($result1)
        {
            foreach($result1 as $result2)
            {
                echo "<a href='product.php?product={$result2['product_id']}'><div class='result-product'>
                            <p class='result-name'>{$result2['product_name']} ({$result2['platform_name']})</p>
                            <p class='result-price'>{$result2['price']} Kč</p>
                      </div></a>";
            }
        }
        else
        {
            echo '<p id="wrong">Nejsou zde žádné hry.<p>';
        }
    }
    else 
    {
        echo '<p id="wrong">Něco je špatne.Zkuste to znovu.<p>';
    }
}
elseif (isset($_GET['search'])) 
{
    $search=$_GET['search'];
    $s_search=strip_tags($search);
    $result=$db1::execute_fetchall('SELECT product_id,product_name,price,platform_name FROM product WHERE product_name LIKE :search',[':search'=> "%$s_search%"]);
    if($result)
    {
        foreach($result as $result0)
        {
            echo "<a href='product.php?product={$result0['product_id']}'><div class='result-product'>
                            <p class='result-name'>{$result0['product_name']} ({$result0['platform_name']})</p>
                            <p class='result-price'>{$result0['price']} Kč</p>
                      </div></a>";
        }
    }
    else
    {
        echo '<p id="wrong">Nejsou zde žádné hry.<p>';
    }
}
else
{
    echo '<p id="wrong">Něco je špatne.Zkuste to znovu.<p>';
}