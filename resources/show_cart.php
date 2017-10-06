<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['cart']))
{
    echo '<div id="table-container"><table>
              <tbody>
                  <tr>
                      <th>Název</th>
                      <th>Počet</th>
                      <th>Cena</th>
                      <th>Akce</th>
                  </tr>';
    foreach($_SESSION['cart'] as $i => $item )
    {
        $price=$_SESSION['cart'][$i]['price']*$_SESSION['cart'][$i]['count'];
        $total_price+=$price;
        echo "<tr>
                  <td>{$_SESSION['cart'][$i]['name']}</td>
                  <td>{$_SESSION['cart'][$i]['count']}</td>
                  <td>$price Kč</td>
                  <td class='cart-remove'><a href='cart.php?delete={$_SESSION['cart'][$i]['name']}'>Odebrat<a></td>
              </tr>";
    }
    echo "<tr>
          <td colspan='2'>Celková cena: </td>
          <td style='border-left:1px solid white;border-right:1px solid white;'>$total_price Kč</td>
          <td style='display: none;'></td>
          </tr>    
          </tbody>
          </table></div>";
    $_SESSION['price']=$total_price;
    echo '<a href="order.php"><button id="order-continue"><span>Pokračovat k objednávce</span></button></a>';
}
else
{
    echo '<p id="empty">V košíku nemáte žádné hry.</p>';
}