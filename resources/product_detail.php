<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_GET['product'])&&$_GET['product']!='')
{
    $id=$_GET['product'];
    $s_id=strip_tags($id);
    $result=$db1::execute_query('SELECT product_id,product_name,description,price,in_stock,platform_name,genre_name,picture,delivery_time FROM product WHERE product_id = :prodid',[':prodid'=> $s_id]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    $output= "<form id='cart-add' method='post' action='product.php?product={$s_id}'>
                <input type='hidden' name='product_id' value='{$result0['product_id']}' id='cart-subm'/>
                <input type='submit' name='pst' id='cart-subm' value='Přidat do košíku'/>
              </form>";
    echo "<div id='smt-container'><div id='picture-container'><div id='picture'>
          <img src='images/{$result0['picture']}'>
          </div></div>
          <div id='rest-container'><div id='p-name'>
              <p>{$result0['product_name']} ({$result0['platform_name']})</p>
          </div>
          <div id='price'>
              <p>Cena:   {$result0['price']} Kč</p>
          </div>
          <div id='genname'>
              <a>
                  <p>Žánr:   {$result0['genre_name']}</p>
              </a>
          </div>
          <div id='time'>";
        if($result0['delivery_time']==1)
        {
            echo '<p>Doba dodání:  1 den</p>';
        }
        if($result0['delivery_time']==2||$result0['delivery_time']==3||$result0['delivery_time']==4)
        {
            echo "<p>Doba dodání: {$result0['delivery_time']} dny</p>";
        }
        if($result0['delivery_time']>=5)
        {
            echo "<p>Doba dodání: {$result0['delivery_time']} dnů</p>";
        }
    echo  '</div>
           <div id="ca">';
    if($result0['in_stock']=='0')
    {
        $output= '<p>Hra není na skladě</p>';
    }
    else
    {
        $output= "<form id='cart-add' method='post' action='product.php?product={$s_id}'>
                    <input type='hidden' name='product_id' value='{$result0['product_id']}' id='cart-subm'/>
                    <input type='submit' name='pst' id='cart-subm' value='Přidat do košíku'/>
                  </form>";
    }
    echo $output;
    echo "</div></div></div>
          <div id='description'>
          <p>{$result0['description']}</p>
          </div>";
}